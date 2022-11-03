<?php

namespace App\Http\Requests\API\Event;

use App\Rules\ExistingEmailRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

// define('MAX_TEAM_SLOT', 4);
// define('MAX_PLAYER_TEAM_SLOT', 10);

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $input = request()->all();

        $input['is_set_role'] = true;
        $input['is_unlimit_max'] = true;

        $max_teams = [];
        $max_player_per_team = [];
        $sport_id = [];
        $is_unlimit_max = '';
        $is_set_role = [];
        $list_position = [];
        $number_of_position = [];
        $select_only_once = [];
        $selected_team_id = [];
        $title = ['required'];
        $level_id = [];
        $location = ['required'];
        $lat = ['required'];
        $long = ['required'];
        $schedule = [];
        $application_validator = 'in:team,individual';
        $private_code = ['required_if:is_public,==,false'];

        if (isset($input['event_type'])) {
            switch ($input['event_type']) {
                case 'pickup':
                    $max_teams = [
                        'required',
                        'numeric',
                        'min:0',
                        'max:' . MAX_TEAM_SLOT,
                    ];
                    // $max_player_per_team = [
                    //     'min:0',
                    //     'max:' . MAX_PLAYER_TEAM_SLOT,
                    // ];
                    $sport_id = ['required'];
                    $is_set_role = ['boolean'];
                    $arrRequired = $this->checkValidatePickUp($input);
                    if ($input['application_type'] != 'team') {
                        $list_position = $arrRequired['list_position'];
                        $number_of_position =
                            $arrRequired['number_of_position'];
                    } else {
                        $selected_team_id = ['required', 'numeric'];
                    }
                    $select_only_once = $arrRequired['select_only_once'];
                    $title = [];
                    break;
                case 'league':
                    $sport_id = ['required', 'numeric'];
                    $title = [];
                    $max_teams = ['required', 'in:4,8,16'];
                    $level_id = ['required', 'numeric'];

                    $application_validator = 'in:team';
                    $private_code = [];
                    break;
                default:
                    $max_teams =
                        isset($input['application_type']) &&
                        $input['application_type'] == 'team' &&
                        isset($input['is_unlimit_max']) &&
                        !$input['is_unlimit_max']
                            ? ['required', 'numeric', 'min:0']
                            : [];
                    $max_player_per_team =
                        isset($input['application_type']) &&
                        $input['application_type'] == 'individual' &&
                        isset($input['is_unlimit_max']) &&
                        !$input['is_unlimit_max']
                            ? ['required', 'numeric', 'min:0']
                            : [];
                    $is_unlimit_max = 'required';
                    break;
            }

            if (
                isset($input['venue_book_id']) &&
                !is_null($input['venue_book_id'])
            ) {
                $location = [];
                $lat = [];
                $long = [];
            } else {
                $schedule = ['required', 'array'];
            }
        }

        return [
            'event_type' => ['required', 'in:league,sport,pickup,session'],
            'sport_id' => $sport_id,
            'max_team' => $max_teams,
            'max_player_per_team' => $max_player_per_team,
            'is_unlimit_max' => [$is_unlimit_max],
            'application_type' => ['required', $application_validator],
            'gender' => ['nullable', 'in:female,male,lgbt,all'],
            'location' => $location,
            'lat' => $lat,
            'long' => $long,
            'is_paid' => ['boolean', 'required_if:event_type,==,league'],
            'is_public' => ['required', 'boolean'],
            'private_code' => $private_code,
            'is_set_role' => $is_set_role,
            'list_position' => $list_position,
            'number_of_position' => $number_of_position,
            'select_only_once' => $select_only_once,
            'age_group' => ['required', 'in:0,1,2,3,4,5,6'],
            'title' => $title,
            'selected_team_id' => $selected_team_id,
            'level' => $level_id,
            'venue_book_id' => ['nullable'],
            'schedule' => ['required_without:venue_book_id'],
        ];
    }

    #[ArrayShape(['number_of_position.required' => "string",'select_only_once.required' => "string"])]
    public function messages(): array
    {
        return [
            'number_of_position.required' =>
                'Number of positions is not correct',
            'select_only_once.required' =>
                'Creator cannot apply more than one position',
        ];
    }

    public function checkValidatePickUp($input = [])
    {
        $list_position = [];
        $number_of_position = [];
        $select_only_once = [];
        if (!$input['is_set_role']) {
            $list_position = 'required';
            if (isset($input['list_position'])) {
                $number_of_position =
                    count($input['list_position']) !=
                    $input['max_player_per_team']
                        ? 'required'
                        : '';
                if (!$number_of_position) {
                    $count = 0;
                    foreach ($input['list_position'] as $item) {
                        if ($item['status']) {
                            $count++;
                        }
                    }
                    if ($count >= 2) {
                        $select_only_once = 'required';
                    }
                }
            }
        }
        return [
            'list_position' => $list_position,
            'number_of_position' => $number_of_position,
            'select_only_once' => $select_only_once,
        ];
    }
}
