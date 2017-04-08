<?php 

namespace Katana\Builders\Post;

use Illuminate\Filesystem\Filesystem;

class BladeOutput implements PostOutputInterface
{	
	/**
	 * Save post templare
	 *
	 * @param sting $title
	 * @return void
	 */
	public function build($post_path, $title = "My new post")
	{	
		$filesystem = new Filesystem();
		$template 	= $this->template($title, date('F d, Y'));

		$filesystem->put($post_path.'.blade.php', $template);
	}

	/**
     * Return the default template of the new post
     *
     * @return string $title
     * @return string $date
     * @return string
     */
    protected function template($title, $date)
    {	
        return <<<BLADE
@extends('_includes.blog_post_base')

@section('post::title', "$title")
@section('post::date', "$date")
@section('post::brief', 'Write the description of the post here!')
@section('pageTitle')- @yield('post::title')@stop

@section('post_body')
    @markdown
        Write your the content of the post here!
    @endmarkdown
@stop
BLADE;
    }
}