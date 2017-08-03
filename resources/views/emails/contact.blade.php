<!DOCTYPE html>
 <html lang="en-EN">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
  
                <h3>Website Feedback</h3>
            
                    <table class="table">
                      <tbody>
                        <tr>
                            <td>Name:</td>
                            <td>{{$user['name']}}</td>
                        </tr>
                        
                        <tr>
                            <td>Email:</td>
                            <td>{{$user['email']}}</td>
                        </tr>
                        
                        <tr>
                            <td>Phone Number:</td>
                            <td>{{$user['phone']}}</td>
                        </tr>
                        <tr>
                            <td>Message:</td>
                            <td>{{$user['user_message']}}</td>
                        </tr>
                      </tbody>
                    </table>
                
</body>
</html>