<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class Activities extends Component
{
    use WithFileUploads;

    public $activities, $name, $description, $date, $type, $file_path, $file,  $teams, $team, $activity_id;
    public $isOpen = 0;


    public function render()
    {
        $this-> activities = Activity::all();
        $this-> teams = Team::all();
        return view('livewire.activities');
    }

    protected $rules = [
        'team' => 'required|min:1',
    ];

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->description = '';
        $this->activity_id= '';
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'team' => 'required',
            'type' => 'required',
            'file' => 'required|max:20480', // Max file size of 20 MB
        ]);

        $uploadedName = $this->file->getClientOriginalName();
        $filename = $validatedData['date'].'_'.$uploadedName;

        //  $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
        $filePath = $validatedData['file']->storeAs($validatedData['team'], $filename);
        $validatedData['file_path'] = '/storage/' . $filePath;
        // dd($validatedData);

        $userId = Auth::user()->id;

        Activity::updateOrCreate(
            ['id' => (int)$this->activity_id], [
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'team_id' => $validatedData['team'],
            'type' => $validatedData['type'],
            'file_path' => $validatedData['file_path'],
            'user_id' => $userId,
            'description' => $validatedData['description']
        ]);
    //     $this->filename = $filename;

    session()->flash('message',
        $this->activity_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.');

    $this->closeModal();
    $this->resetInputFields();
    }


    public function edit($id)
    {
        $Activities = Activities::findOrFail($id);
        $this->Activities_id = $id;
        $this->name = $Activities->name;
        $this->description = $Activities->description;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('message', 'Todo Deleted Successfully.');
    }
}
