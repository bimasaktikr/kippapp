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

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'team' => 'required',
        ]);
        
        $fileModel = new Activities;

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->user_id = 1;
            $fileModel->date = $req->date;
            $fileModel->team_id = 4;
            $fileModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }

        $userId = Auth::user()->id;

        Activity::updateOrCreate(
            ['id' => (int)$this->activity_id], [
            'name' => $this->name,
            'date' => $this->date,
            'team_id' => $this->team,
            'type' => $this->team,
            'file_path' => $this->team,
            'user_id' => $userId,
            'description' => $this->description
        ]);
        // $activity_check = Activity::where('id', $activity_id)->first();
        // if($activity_check) {
        //     $activity_check->update([
        //             'name' => $this->name,
        //             'date' => $this->date,
        //             'team_id' => $this->team,
        //             'type' => $this->team,
        //             'file_path' => $this->team,
        //             'user_id' => $this->team,
        //             'description' => $this->description
        //         ]);
        // } else {
        //     Activity::create([
        //         'name' => $this->name,
        //             'date' => $this->date,
        //             'team_id' => $this->team,
        //             'type' => $this->team,
        //             'file_path' => $this->team,
        //             'user_id' => $this->team,
        //             'description' => $this->description
        //     ]);
        // }
   
        session()->flash('message', 
            $this->activity_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.');
   
        $this->closeModal();
        $this->resetInputFields();
    }

    public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required'
        ]);

        $fileModel = new Activities;

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->user_id = 1;
            $fileModel->date = $req->date;
            $fileModel->team_id = 4;
            $fileModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
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
