<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;



class Activities extends Component
{
    use WithFileUploads;

    public  $activities,
            $name,
            $description,
            $date,
            $type,
            $file_path,
            $file,
            $teams,
            $team,
            $size,
            $activity_id,
            $isPreviewOpen,
            $filename;
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

    public function openModalPreview()
    {
        $this->isPreviewOpen = true;
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
        $this->isPreviewOpen = false;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->description = '';
        $this->activity_id= '';
    }
    public function copyToClipboard($id)
    {
        $activities = Activity::findOrFail($id);
        $this->preview_url = Storage::url($activities->file_path);

        // $data = "This is the data to be copied to the clipboard";
        // $escaped_data = str_replace('"', '\"', $data); // escape double quotes
        $js = <<<JS
            var el = document.createElement('textarea');
            el.value = $this->preview_url;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        JS;
        $this->dispatchBrowserEvent('copy', $js);
        session()->flash('copied', true);
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
        $filePath = $validatedData['file']->storeAs($validatedData['team'], $filename, 'public');
        // $validatedData['file_path'] = '/storage/' . $filePath;
        $validatedData['file_path'] =  $filePath;
        // dd($validatedData);
        // $link = Storage::url;

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

        session()->flash('message',
        $this->activity_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $Activities = Activity::findOrFail($id);
        $this->Activities_id = $id;
        $this->name = $Activities->name;
        $this->description = $Activities->description;

        $this->openModal();
    }

    public function preview($id)
    {
        $activities = Activity::findOrFail($id);
        $this->preview_url = Storage::url($activities->file_path);
        // $this->preview_url = URL::asset($activities->file_path);
        // $this->size = Storage::size($this->preview_url);
        // dd($this->preview_url);
        // dd($this->size);
        $this->openModalPreview();
        // Contact::create(['email' => $this->email]);

        // $url = Route::
        // $activities['url'] = $url;
        // $script = "window.open('$url', '_blank');";
        // $this->dispatchBrowserEvent('open-new-tab', ['script' => $script]);

        // $view = view('public', $activities);
        // $response = response($view)->withHeaders([
        //     'Content-Disposition' => 'inline'
        // ]);
        // return $response;

        // return redirect()->to('/public/'.$id);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Activity::find($id)->delete();
        session()->flash('message', 'Todo Deleted Successfully.');
    }
}
