@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
         {{ session('success') }}
    </div>
    @endif
     @if(session()->has('danger'))
    <div class="alert alert-danger" role="alert">
        {{ session('danger') }}
        </div>
    @endif
    
    @if(isset($books))
    <table class="table">
    <thead>
    
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th><a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Add Entry</a></th>
        <th><a data-toggle="modal" data-target="#exampleModal3" class="btn btn-primary">Deleted Books</a></th>
        
      </tr>
    </thead>
    <tbody>
    @foreach($books ?? '' as $book)

    <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->author}}</td>
        <td><a data-toggle="modal" data-id="{{$book->id}}"  data-target="#exampleModal2" class="btn btn-secondary updateEntry">Update Entry</a></td>
        <td><a data-toggle="modal" id="{{$book->id}}" onclick="softDeleteRecord(this.id)" class="btn btn-warning">Delete Entry</a></td>
      </tr>
    @endforeach
      
      
    </tbody>
  </table>
 @endif
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Book Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="insertForm" action="">
        @csrf
      
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
               <button type="submit" id="addBook" class="btn btn-primary">Add Entry</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
          
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Book Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updateForm" action="">
        @csrf
          
            <input type="text" name="title" class="updateTitle" placeholder="Book Title" required>
            <input type="text" name="author" class="updateAuthor" placeholder="Author" required>
            <input type="hidden" name="id" class="updateBookId">
         
            <button type="submit" id="updateBook" class="btn btn-primary">Update Entry</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="updateBook" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
          
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Book Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          @if(isset($deletedBooks))
    <table class="table">
    <thead>
    
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th></th>    
        <th></th>    
      </tr>
    </thead>
    <tbody>
    @foreach($deletedBooks ?? '' as $book)

    <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->author}}</td>
        <td><a id="{{$book->id}}" class="btn btn-secondary restoreEntry">Restore</a></td>
        <td><a id="{{$book->id}}" class="btn btn-secondary deleteEntryPermanent">Delete</a></td>
        
      </tr>
    @endforeach
      
      
    </tbody>
  </table>
 @endif

          
      </div>
      <div class="modal-footer">
        <button type="button" id="updateBook" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

@endsection
