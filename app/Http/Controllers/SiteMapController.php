<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Posts;

class SiteMapController extends Controller
{
	public function generate_sitemap()
	{
		try {

			$sitemap = "<?xml version='1.0' encoding='UTF-8'?>
			<urlset xmlns='http://www.google.com/schemas/sitemap/0.84' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd'>

			<url>
			<loc>".route('index')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('listings')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>";
			for ($i=1; $i<10; $i++) {
				$sitemap .="
			<url>
			<loc>".route('listings')."?cat_id=".$i."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>";
			}

			$sitemap .="
			<url>
			<loc>".route('contact-us')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('howitworks')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('about-us')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('privacy-policy')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('terms-and-conditions')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			<url>
			<loc>".route('faqs')."</loc>
			<changefreq>weekly</changefreq>
			<priority>1.00</priority>
			</url>
			";
			$posts = Posts::where('status', 'active')->select('title','id','updated_at')->get();
			foreach ($posts as $post) {
				$sitemap .="
				<url>
				<loc>".route('single_post',['id'=>$post->id, 'title' => str_replace('+','-',rawurlencode($post->title)) ])."
				</loc>
				<lastmod>".$post->updated_at."</lastmod>
				<changefreq>weekly</changefreq>
				<priority>1.00</priority>
				</url>";
			}

			$sitemap .="
			</urlset>";

			$myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
			fwrite($myfile, $sitemap);
			fclose($myfile);

			Session::flash("msg_success","The sitemap has been generated.");
			
		} catch (Exception $e) {
			Session::flash("msg_error",$e->getMessage());
		}
		return redirect()->route("dashboard");
	}
}
