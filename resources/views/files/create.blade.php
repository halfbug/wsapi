@extends('layouts.frontend')

@section('content')
	<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload File</div>
                <div class="panel-body">
        
            <form  method="post" action="" class="form-horizontal">
                
                    <div class="form-group" >
                        <label for="field1 " class="col-sm-3 control-label">Deletion period</label>
                        <div class="col-sm-9">
                            <label for="field1 " class="col-sm-3 control-label">24 hours</label>
                        </div>
                        
                    </div>

                   <!-- <div class="form-group ">
                        <label for="field1 " class="col-sm-3 control-label">Please select</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="1">Field 1</option>
                                <option value="2">Field 2</option>
                            </select>
                        </div>
                    </div>
                -->
                    <div class="form-group">
                        <label for="file"  class="col-sm-3 control-label">File</label>
                        <div class="col-sm-6">
                            <input  id="file" type="file" >
                        </div>
                    </div>

                
                <div class="form-group">
                	<div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>  
            </form>
           </div>
           </div>
           </div>  
        </div>
        </div>
@endsection