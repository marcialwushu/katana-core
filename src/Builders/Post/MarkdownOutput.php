<?php 

namespace Katana\Builders\Post;

use Illuminate\Filesystem\Filesystem;

class MarkdownOutput implements PostOutputInterface
{
	/**
	 * Save a post template in _blog directory
	 *
	 * @param sting $title
	 * @return void
	 */
	public function build($post_path, $title = "My new post")
	{
		$filesystem = new Filesystem();
		$template 	= $this->template($title, date('F d, Y'));

		$filesystem->put($post_path.'.md', $template);
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
        return <<<MARKDOWN
---	
view::extends: _includes.blog_post_base
view::yields: post_body
pageTitle: "$title"
post::title: "$title"
post::date: "$date"
post::brief: Write the description of the post here!
---

Write your post content here!
MARKDOWN;
    }
}