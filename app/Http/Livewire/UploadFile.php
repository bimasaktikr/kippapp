<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activities;

class UploadFile extends Component
{   

    public $todos, $title, $description, $todo_id;
    public $isOpen = 0;


    public function render()
    {
        $this->todos = Activities::all();
        return view('livewire.todos');
    }

   
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
        $this->title = '';
        $this->description = '';
        $this->todo_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        Todo::updateOrCreate(['id' => $this->todo_id], [
            'title' => $this->title,
            'description' => $this->description
        ]);
   
        session()->flash('message', 
            $this->todo_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.');
   
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
        $Todo = Todo::findOrFail($id);
        $this->todo_id = $id;
        $this->title = $Todo->title;
        $this->description = $Todo->description;
     
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
