<div class="container d-flex flex-column align-content-left">
    <h2>Hello,</h2>
    <p>Task {{$task->name}} had been changed.</p>
    <button class="btn btn-success">
        <a href="{{route('tasks.show', $task->id)}}">See changes</a>
    </button>
    <img src="/img/wame.png" class="navbar-brand-img mt-3" alt="main_logo" width="50">
</div>