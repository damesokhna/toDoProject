@props(['name'])
<div x-data="{show:true}"
        x-on:open.window="show=($event.detail.name=='add')"
        x-on:opp.window="show=!($event.detail.name=='list')"
>
   <div x-show='!show' name='add'>
    @include("includes.create-todo-box") 
   </div>   
    <div x-show='show'  >
        @include("includes.search")    
        <div id="todos-list">
            @foreach ($todos as $todo)
                @include('includes.todo-card')
            @endforeach
            <div class="my-2">  
                <!-- Pagination goes here -->
                {{$todos->links()}}
            </div>
        </div>
    </div>
</div>