<?php

namespace App\Http\Controllers\API\Announcement;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Announcement\AnnouncementRequest;
use App\Models\Event;
use App\Models\Invite;
use App\Models\EventSquad;
use App\Models\EventPosition;
use App\Models\UserEvent;
use Validator;
use App\Http\Resources\EventResource;
use DateTime;
use App\Http\Requests\API\Event\EventRequest;
use App\Models\Announcement;

define('MAX_TEAM_SLOT', 4);
define('MAX_PLAYER_TEAM_SLOT', 10);
const LIST_APPLICATION_TYPE = ['team', 'individual'];
const LIST_TYPE_ANNOUNCEMENT = ['sport', 'league', 'session'];

class AnnouncementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $offset = isset($input['page']) ? $input['page'] : 0;
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;

        $results = Announcement::whereNull('deleted_at')
            ->paginate($limit)
            ->toArray();

        $metadata = null;

        if (count($results) > 0) {
            $metadata = $this->resMetaData($results);
        }
        return $this->sendResponse($results['data'], 'success', $metadata);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $announcementRequest)
    {
        $input = $announcementRequest->all();
        if (
            empty($input['type']) ||
            !in_array($input['type'], LIST_TYPE_ANNOUNCEMENT)
        ) {
            return $this->sendError('type is not available or incorrect');
        }

        // ADD EVENT
        $datetime = new DateTime(date('Y-m-d H:i:s'));
        $format_create_time_now = $datetime->format(DateTime::ATOM);
        $dataInsert = $this->customData($input);
        $dataInsert['created_at'] = $format_create_time_now;
        $dataInsert['updated_at'] = $format_create_time_now;
        $announcement = Announcement::create($dataInsert);
        // ADD INVITES
        if (!empty($announcement)) {
            $announcement = $announcement->toArray();
            $announcement_type = $announcement['type'];
            $announcement_id_created = $announcement['id'];
            $status =
                $announcement['status'] == 'publish' ? 'publish' : 'unpublish';
            $creator_id = auth()->user()->id;

            $dataInvites = [
                'source_id' => $announcement_id_created,
                'status' => $status,
                'creator_id' => $creator_id,
                'first_name' => null,
                'last_name' => null,
                'email' => null,
                'response' => null,
            ];
            Invite::create($dataInvites);

            // ADD EVENT_SQUAD NEU event_type = pickup
            if (
                $announcement_type == LIST_TYPE_ANNOUNCEMENT[0] &&
                $announcement['type'] == LIST_APPLICATION_TYPE[1]
            ) {
                $announcement_id_created = $announcement['id'];
                $dataEventSquad = [
                    'event_id' => $announcement_id_created,
                ];
                $announcement_squad = EventSquad::create($dataEventSquad)->toArray();

                // ADD EVENT_POSITION
                $announcement_id_created = $announcement['id'];
                $max_player_per_team = $announcement['max_player_per_team'];
                $list_position = isset($input['list_position'])
                    ? json_decode(json_encode($input['list_position']), true)
                    : [];
                $position_id_user_created = null;
                for ($i = 0; $i < $max_player_per_team; $i++) {
                    $name_position = isset($list_position[$i]['name'])
                        ? $list_position[$i]['name']
                        : null;
                    $weight_position = isset($list_position[$i]['weight'])
                        ? $list_position[$i]['weight']
                        : null;
                    $status_player_selected = isset(
                        $list_position[$i]['status']
                    )
                        ? $list_position[$i]['status']
                        : null;
                    $dataEventPosition = [
                        'event_id' => $announcement_id_created,
                        'name' => $name_position,
                        'weight' => $weight_position,
                    ];
                    $announcementPosition = EventPosition::create(
                        $dataEventPosition
                    )->toArray();
                    if ($status_player_selected) {
                        $position_id_user_created = $announcementPosition['id'];
                    }
                }

                // ADD USER_EVENT
                if (!is_null($position_id_user_created)) {
                    $dataUserEvent = [
                        'event_id' => $announcement_id_created,
                        'user_id' => $user_id,
                        'position_id' => $position_id_user_created,
                        'event_squad_id' => $announcement_squad['id'],
                    ];
                    UserEvent::create($dataUserEvent);
                }
            }
        }

        return $this->sendResponse($announcement, 'Event created successfully.');
    }

    // CUSTORM DATA
    public function customData($input)
    {
        if (empty($input)) {
            return [];
        }
        $dataInsert = [
            'sport_id' => isset($input['sport']['id'])
                ? $input['sport']['id']
                : null,
            'max_team' => isset($input['max_team']) ? $input['max_team'] : null,
            'is_paid' => isset($input['is_paid']) ? $input['is_paid'] : null,
            'max_player_per_team' => isset($input['max_player_per_team'])
                ? $input['max_player_per_team']
                : null,
            'application_type' => isset($input['application_type'])
                ? $input['application_type']
                : null,
            'gender' => isset($input['gender']) ? $input['gender'] : null,
            'start_date_time' => isset($input['start_date_time'])
                ? $input['start_date_time']
                : null,
            'end_date_time' => isset($input['end_date_time'])
                ? $input['end_date_time']
                : null,
            'location' => isset($input['location']) ? $input['location'] : null,
            'lat' => isset($input['lat']) ? $input['lat'] : null,
            'long' => isset($input['long']) ? $input['long'] : null,
            'is_paid' => isset($input['is_paid']) ? $input['is_paid'] : null,
            'title' => isset($input['title']) ? $input['title'] : null,
            'caption' => isset($input['caption']) ? $input['caption'] : null,
            'is_set_role' => isset($input['is_set_role'])
                ? $input['is_set_role']
                : null,
            'start_age' => isset($input['start_age'])
                ? $input['start_age']
                : null,
            'end_age' => isset($input['end_age']) ? $input['end_age'] : null,
            'fee' => isset($input['fee']) ? $input['fee'] : null,
            'is_public' => isset($input['is_public'])
                ? $input['is_public']
                : null,
            'status' => 1,
            'event_type' => isset($input['event_type'])
                ? $input['event_type']
                : null,
            'description' => isset($input['description'])
                ? $input['description']
                : null,
            'is_unlimit_max' => isset($input['is_unlimit_max'])
                ? $input['is_unlimit_max']
                : false,
            'about' => isset($input['about']) ? $input['about'] : null,
            'mechanics' => isset($input['mechanics'])
                ? $input['mechanics']
                : null,
        ];
        return $dataInsert;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDetailEvent($id)
    {
        $results = Event::whereNull('deleted_at')
            ->where('id', $id)
            ->get()
            ->toArray();
        if (is_null($results)) {
            return $this->sendError('Event not found.');
        }

        return $this->sendResponse(new EventResource($results[0]), 'Success');
    }

    // UPDATE EVENT
    public function updateEvent(Request $request, $id)
    {
        $input = $request->all();
        $announcement = Event::find($id);
        if (empty($announcement)) {
            return $this->sendError('Event Not Found!');
        }
        if (
            empty($input['event_type']) ||
            !in_array($input['event_type'], LIST_TYPE_ANNOUNCEMENT)
        ) {
            return $this->sendError('type is not available or incorrect');
        }

        $validator = $this->validateEvent($input);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $datetime = new DateTime(date('Y-m-d H:i:s'));
        $format_create_time_now = $datetime->format(DateTime::ATOM);
        $dataUpdate = $this->customData($input);
        $dataUpdate['updated_at'] = $format_create_time_now;
        $res = $announcement->update($dataUpdate);
        if ($res) {
            return $this->sendResponse([], 'Event updated successfully.');
        } else {
            return $this->sendResponse([], 'Event updated failed.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Event::find($id);
        if (empty($announcement)) {
            return $this->sendError('Event Not Found!');
        }

        $datetime = new DateTime(date('Y-m-d H:i:s'));
        $format_create_time_now = $datetime->format(DateTime::ATOM);

        $res = $announcement->update(['deleted_at' => $format_create_time_now]);
        if ($res) {
            return $this->sendResponse([], 'Event deleted successfully.');
        } else {
            return $this->sendResponse([], 'Event deleted failed.');
        }
    }
}
