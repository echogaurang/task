<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Book;
use App\Jobs\SendEmail;
use Validator;

class BookController extends Controller
{
    

    public function addBook(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        
        DB::beginTransaction();

    try{
        
        $book = Book::create($input);

        DB::commit();

         $success = [
            'success' => true,
            'data' => $book,
            'message' => 'Record Deleted successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Added",
                "body"=>"Hey,New Record Is Added In Your Account"
            ];
        dispatch(new SendEmail($details));

    }catch(\Exception $e){
        DB::rollback();
         $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Deleted As An Exception Occured'
            ];
        echo json_encode($exception);
    }
    }
    
    
    public function softDeleteRecord(Request $request){
        if($request->ajax()){
        $user = Auth::user();
        $input = $request->all();
        DB::beginTransaction();
         
        try{
        
        $book = Book::find($input['id']);
        $final = $book->delete();
            
        DB::commit();

        $success = [
            'success' => true,
            'data' => $final,
            'message' => 'Record Deleted successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Deleted",
                "body"=>"Hey,New Record Is Deleted In Your Account"
            ];
        dispatch(new SendEmail($details));

        
            
            
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Deleted As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
        
    }
    }
    public function addrecord(Request $request){ 
        
      $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }
        
        $input = $request->all();

      
        DB::beginTransaction();
        
        try{
        
        $book = Book::create($input);

        DB::commit();

        $success = [
            'success' => true,
            'data' => 'Book Added',
            'message' => 'Record Added successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Added",
                "body"=>"Hey,New Record Is Added In Your Account"
            ];
        dispatch(new SendEmail($details));

        
            
            
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Added As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
        
    }
    
    public function updateRecord(Request $request){ 
        $input = $request->all();
        $input = $input['id'];
        
        
        DB::beginTransaction();
        
        try{
        
        $book = Book::find($input);

        DB::commit();

        $success = [
            'success' => true,
            'data' => $book,
            'message' => 'Record Found successfully.'
        ];
        echo json_encode($success);
    
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not fOUND As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
    }
    
    public function updateBook(Request $request){ 
        
      $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }
        
        $input = $request->all();

      
        DB::beginTransaction();
        
        try{
        
        $book = Book::find($input['id']);
        $book->update([
            'title' => $input['title'],
            'author'=> $input['author'],
        ]);
        DB::commit();

        $success = [
            'success' => true,
            'data' => 'Book Added',
            'message' => 'Record Added successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Updated",
                "body"=>"Hey,New Record Is Updated In Your Account"
            ];
        dispatch(new SendEmail($details));

        
            
            
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Updated As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
        
    }
    
    public function permanentDelete(Request $request){
        if($request->ajax()){

        $input = $request->all();
        $id = $input['id'];
        DB::beginTransaction();
          
        try{
        
        $book = Book::onlyTrashed()->where('id',$id)->forceDelete();
    
            
        DB::commit();

        $success = [
            'success' => true,
            'data' => $book,
            'message' => 'Record Deleted successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Deleted Permanently",
                "body"=>"Hey,New Record Is Deleted In Your Account"
            ];
        dispatch(new SendEmail($details));

        
            
            
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Deleted As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
        
    }
    }
    
    public function restoreEntry(Request $request){
        if($request->ajax()){
        
        $input = $request->all();
        $id = $input['id'];
        DB::beginTransaction();
          
        try{
        
        $book = Book::onlyTrashed()->where('id',$id)->restore();
    
        DB::commit();

        $success = [
            'success' => true,
            'data' => $book,
            'message' => 'Record Restored successfully.'
        ];
        echo json_encode($success);
         $details=[
                "email"=>$user->email,
                "title"=>"New Record Restored",
                "body"=>"Hey,New Record Is Restored In Your Account"
            ];
        dispatch(new SendEmail($details));

        
            
            
    }
        catch(\Exception $e){
        DB::rollback();
        $exception = [
                'success' => false,
                'data' => 'Error.',
                'message' => 'Record Not Restored As An Exception Occured'
            ];
        echo json_encode($exception);
    }
        
        
    }
    }
    
    
    
    
}
