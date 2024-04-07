<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{  
    use WithPagination;
    #[Rule('required|min:2|max:50')]
    public $name;
    
    #[Url(as:'s')]
    public $search;
    public $editingId;
    #[Rule('required|min:2|max:50')]
    public $editingName;
    public function create(){
        $validated = $this->validateOnly('name');
      //  dd($validated['name']);
        Todo::create($validated);
        $this->reset();
        session()->flash('success','Created');    
        $this->resetPage();
     }
     public function delete($id){
        Todo::find($id)->delete();

     }
     public function toggle($id){
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();  
     }
     public function edit($id){
        $this->editingId = $id;
        $this->editingName = Todo::find($id)->name;
     }
     public function cancel(){
        $this->reset('editingId','editingName');
     }
     public function update(){
     $validated = $this->validateOnly('editingName');
     Todo::find($this->editingId)->update([
        'name'=> $this->editingName,
     ]);
     $this->cancel();
     } 
    public function render()
    {    
        return view('todo-list',[
            'todos'=>   ->paginate(5)
        ]);
    }
}
