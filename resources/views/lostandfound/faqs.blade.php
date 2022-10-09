@include("lostandfound.header")



@include("lostandfound.search_bar")


<div class="container site-section">

    	<h2 class="text-center same-color mb-3">Frequently Asked Questions</h2>
	
	<div id="content-faq">

		<div id="accordion" class="accordion-container">
				<article class="content-entry">
						<h4 class="article-title"><i></i>Do you have hold the things physically and return it to owners?</h4>
						<div class="accordion-content">
								<p>No. We dont hold things physically. We just provide a platform so the users can post about their lost and found things here. And visitors can contact the person directly, who posted the ad.</p>
								<p>For example if a person lost a thing, he/she can post it at Findwala and our visitors can see the posts and can contact the post owner directly, without our involvement. Similarly if a person who found a thing, can post it at Findwala and if the owner finds the post, he can contact the post owner directly to get the lost thing back.</p>
						</div>
						<!--/.accordion-content-->
				</article>

				<article class="content-entry">
						<h4 class="article-title"><i></i>Can a user post on other users behalf?</h4>
						<div class="accordion-content">
								<p>Yes sure. User can post on other user's behalf for example, brother, sister, friend, relative or any other person even unknown persons. But it should be only with positive intent. It should not be to tease the person.</p>
						</div>
						<!--/.accordion-content-->
				</article>

				<article class="content-entry">
						<h4 class="article-title"><i></i>Are there any kind of hidden or visible charges?</h4>
						<div class="accordion-content">
								<p>No. We dont charge. We provide free of cost services.</p>
						</div>
						<!--/.accordion-content-->
				</article>

				<article class="content-entry">
						<h4 class="article-title"><i></i>Do you guarantee to get the lost things back to the owner?</h4>
						<div class="accordion-content">
								<p>No. We dont guarantee that the owner will get the lost thing back. We just give a hope.</p>
						</div>
						<!--/.accordion-content-->
				</article>

		</div>
		<!--/#accordion-->

	</div>

</div>






@include("lostandfound.footer")

</body>

</html>

<script type="text/javascript">

$(function() {
		var Accordion = function(el, multiple) {
				this.el = el || {};
				this.multiple = multiple || false;

				var links = this.el.find('.article-title');
				links.on('click', {
						el: this.el,
						multiple: this.multiple
				}, this.dropdown)
		}

		Accordion.prototype.dropdown = function(e) {
				var $el = e.data.el;
				$this = $(this),
						$next = $this.next();

				$next.slideToggle();
				$this.parent().toggleClass('open');

				if (!e.data.multiple) {
						$el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
				};
		}
		var accordion = new Accordion($('.accordion-container'), false);
});

$(document).on('click', function (event) {
  if (!$(event.target).closest('#accordion').length) {
    $this.parent().toggleClass('open');
  }
});

</script>
