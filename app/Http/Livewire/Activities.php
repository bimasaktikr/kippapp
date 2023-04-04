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

    public $activities, $name, $description, $date, $type, $file_path,  $teams, $team, $activity_id;
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
            'description' => 'required',
            'team' => 'required',
            'file' => 'required|max:20480', // Max file size of 20 MB
        ]);
 
        $filename = time().'.'.$validatedData['file']->getClientOriginalExtension();

        $validatedData['file']->storeAs('public', $filename);

        $this->filename = $filename;

        session()->flash('message', 'File uploaded successfully.');
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
