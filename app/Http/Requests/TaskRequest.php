<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191']
        ];
    }

    /**
     * Update the specified task resource
     * 
     */
    public function insert($todo_list)
    {
        $data = $this->all();
        $data['todo_list_id'] = $todo_list->id;
        return Task::create($data);
    }

    /**
     * Update the specified task resource
     * 
     */
    public function update($task)
    {
        $data = $this->all();
        return tap($task)->update($data);
    }
}