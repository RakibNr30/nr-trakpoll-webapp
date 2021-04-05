<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('backend/plugins/jqvmap/jqvmap.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@yield('styles')

<!---Modal Css---->
<style>
body {
font-family: 'Varela Round', sans-serif;
}
.modal-confirm {    
color: #636363;
width: 400px;
}
.modal-confirm .modal-content {
padding: 20px;
border-radius: 5px;
border: none;
text-align: center;
font-size: 14px;
}
.modal-confirm .modal-header {
border-bottom: none;   
position: relative;
}
.modal-confirm h4 {
text-align: center;
font-size: 26px;
margin: 30px 0 -10px;
}
.modal-confirm .close {
position: absolute;
top: -5px;
right: -2px;
}
.modal-confirm .modal-body {
color: #999;
}
.modal-confirm .modal-footer {
border: none;
text-align: center;   
border-radius: 5px;
font-size: 13px;
padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
color: #999;
}   
.modal-confirm .icon-box {
width: 80px;
height: 80px;
margin: 0 auto;
border-radius: 50%;
z-index: 9;
text-align: center;
border: 3px solid #f15e5e;
}
.modal-confirm .icon-box i {
color: #f15e5e;
font-size: 46px;
display: inline-block;
margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
color: #fff;
border-radius: 4px;
background: #60c7c1;
text-decoration: none;
transition: all 0.4s;
line-height: normal;
min-width: 120px;
border: none;
min-height: 40px;
border-radius: 3px;
margin: 0 5px;
}
.modal-confirm .btn-secondary {
background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
background: #a8a8a8;
}
.modal-confirm .btn-danger {
background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
background: #ee3535;
}
.trigger-btn {
display: inline-block;
margin: 100px auto;
}


body{
    background:#eee;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #FFFFFF;
}
a {
    color: #82b440;
    text-decoration: none;
}
.blog-comment::before,
.blog-comment::after,
.blog-comment-form::before,
.blog-comment-form::after{
    content: "";
	display: table;
	clear: both;
}

.blog-comment{
    padding-left: 15%;
	padding-right: 15%;
}

.blog-comment ul{
	list-style-type: none;
	padding: 0;
}

.blog-comment img{
	opacity: 1;
	filter: Alpha(opacity=100);
	-webkit-border-radius: 4px;
	   -moz-border-radius: 4px;
	  	 -o-border-radius: 4px;
			border-radius: 4px;
}

.blog-comment img.avatar {
	position: relative;
	float: left;
	margin-left: 0;
	margin-top: 0;
	width: 65px;
	height: 65px;
}

.blog-comment .post-comments{
	border: 1px solid #eee;
    margin-bottom: 20px;
    margin-left: 85px;
	margin-right: 0px;
    padding: 10px 20px;
    position: relative;
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
       	 -o-border-radius: 4px;
    		border-radius: 4px;
	background: #fff;
	color: #6b6e80;
	position: relative;
}

.blog-comment .meta {
	font-size: 13px;
	color: #aaaaaa;
	padding-bottom: 8px;
	margin-bottom: 10px !important;
	border-bottom: 1px solid #eee;
}

.blog-comment ul.comments ul{
	list-style-type: none;
	padding: 0;
	margin-left: 85px;
}

.blog-comment-form{
	padding-left: 15%;
	padding-right: 15%;
	padding-top: 40px;
}

.blog-comment h3,
.blog-comment-form h3{
	margin-bottom: 40px;
	font-size: 26px;
	line-height: 30px;
	font-weight: 800;
}
</style>