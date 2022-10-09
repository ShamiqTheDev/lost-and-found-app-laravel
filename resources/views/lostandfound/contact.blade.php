@include("lostandfound.header")
@include("lostandfound.search_bar")
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-7 mb-5"  data-aos="fade">
        @if(Session::has("errors"))
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Failure!</strong> 
          @if ($errors->any())
          {{ implode('', $errors->all(':message')) }}
          @endif
        </div>
        @endif
        @if(Session::has("msg_success"))
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong>
          {{ Session::get("msg_success") }}
        </div>
        @endif
        <form action="{{ route('send-feedback') }}" method="post" class="p-5 bg-white">
          {{ csrf_field() }}
          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="control-label" for="fname">First Name<span>*</span></label>
              <input type="text" required="true" name="firstname" class="form-control rounded">
            </div>
            <div class="col-md-6">
              <label class="control-label" for="lname">Last Name<span>*</span></label>
              <input type="text" required="true" name="lastname" class="form-control rounded">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="control-label" for="email">Email<span>*</span></label>
              <input type="email" required="true" name="email" class="form-control rounded">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="control-label" for="message">Message<span>*</span></label> 
              <textarea required="true" name="message" cols="30" rows="7" class="form-control rounded" placeholder="Write your notes or questions here..."></textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
             <button class="btn same-bg text-white rounded" type="submit">Send Message</button>
           </div>
         </div>
       </form>
     </div>
     <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
      <div class="p-4 mb-3 bg-white">
        <p class="mb-0 font-weight-bold">Email Address</p>
        <p class="mb-0 ahrf-color"><a href="#">info@findwala.com</a></p>
      </div>
      <div class="p-4 mb-3 bg-white">
        <h3 class="h5 text-black mb-3">Get In Touch</h3>
        <p>We want to hear from you and we value your feedback. <br />
          You can contact us for suggestions, advertisements, questions, complaints, reports etc.<br />
          Our team is ready to answer all your questions.<br />Just fill out the form and we'll be in touch as soon as possible.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@include("lostandfound.footer")
</body>
</html>