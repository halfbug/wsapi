Please see my questions and my understanding of document in Blue. 
This site will act as a front end for a file processing service. 
Processing service? API act as service and website will use it 
{Client} Tho whole site with the API are just the front end. So all it needs to do is to received files, count usage, automate purchase of extra credit, and send ready files to the users
Users can upload to the site a specific set of allowed file types along with some additional metadata. Once processed the sending user will receive the result (file) via email, link into a notification area (like Facebook) or directly streamed (as it was requested to be downloaded). 
You mean the user who upload a file will get notify by email? OR the user who upload a file will give a email of another user (let’s say user2) to received file. And user2 notify by email and after login to the site he will see the notification.
{Client} If user (a) uploaded filed (1) and asked for the result to be send in email – response file (2) will be sent to user(a)’s email as attachment.
The ‘back end’ is saving the result (file) into a predefined folder on the front end server and log the necessary metadata so the sending user receive it. 
What folder structure do you have in your mind?
Is it file type specific or anything else?
{Client} As simple possible please. It could be a single folder for uploaded by the users and a separate one for those uploaded by the back end. 

First X number of uploads and results are free, for every extra users must purchase credits. Credit usage is per uploaded file count and extension, defined in to a DB table. 
The X number will be defined by Admin user?
{Client} Yes.
 
Site’s API provides the following functionalities: 
1. Authentications 2. Uploads 3. Downloads 4. Check balance 5. Check file list 6. Search file 7. Get file information 
 
About the site in more details: 
Every user visiting the site can upload up to X number of files without a need for registration. Such guest users can request results to be sent via email or received while they are visiting the site. In this case user’s IP will be logged and email if provided, to avoid abuse of the trial conditions. 
 
Registered user can purchase credit which allows extra files to be uploaded. They are two types of credits: 
1. Fixed amount of files with no expiration date. For example: 10 files
 2. Fixed amount of files per mount for X amount of months. For example: 15 files/per month for the next 13 months. 
Credits are purchased in predefined packages and activated once the online payments confirmed by the payment provide – PayPal. 
Package will be added by Admin user? – {Client} packages will be defined by the admin, yes. What is part of the package will be added to the user’s account after successful payment.
Can you give any example package? Just to understand what information should a package may holds.
{Client}
Valid from Date:  2017-12-11
Valid until Date: 2018-12-11
Allowed number of uploaded files: 55000
Reset uploaded files count:  never or monthly
Price: {$...}
Discount: if prepaid for 1 month – 0%, prepaid 6 months - ?% , prepaid 12 months - ??% 


About the additional metadata that needs to be stored with each file uploaded: 
1. Field 1: A timestamp – which by default is 24 hours after file upload to the server, is completed. Indicated when file will be deleted. 
2. Fields 2-10: varchar (50): with predefined but editable values pulled from a DB table. Registered user can save custom values for future uploads. 
3. Fields 11-15: number (11): with predefined but editable values pulled from a DB table. Registered user can save custom values for future uploads. 
Please provide a simple layout of file upload form OR a sample form. In which you mention the field’s names also.
{Client} Please see examples provided in Project1123_v2.pdf.
Back end users are of just one type and can perform the following actions: 
1. Review the total amount of files uploaded by and sent to users in the last 7 days.  {Client} How much complication is if this is changed to 31 days, i.e. a month?
2. How long it took for the result to be generated. Difference from the time result was available for download and the timestamp from the user’s successful his/her file. 
3. Count files uploaded and downloaded by guest/free and registered users in the last 7 days .  {Client} How much complication is if this is changed to 31 days, i.e. a month?

4. Upload and download file counts per Website and the API in the last 7 days .  {Client} How much complication is if this is changed to 31 days, i.e. a month?

5. Create and edit packages
 6. Review credit(s) usage per user 
how you define credits usage per user? 
{Client} By how many files were uploaded by him/her
Limitations: 
The final product should be delivered in a way so it can be installed and used on web hosting with shared account. Database MySQL and written on PHP 7.
We are going to use Laravel 5.4 for both website and API. It is PHP framework with MySQL database. 
Note: Please make sure that your hosting have latest PHP installed as Laravel works only on php5.6 or above.
{Client} Yes, that’s ok.
