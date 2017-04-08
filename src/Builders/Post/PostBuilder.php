<?php

namespace Katana\Builders\Post;

use Katana\Builders\Post\PostOutputInterface;

class PostBuilder
{
    /**
     * @var string
     */
    private $output;

    /**
     * PostBuilder constructor.
     *
     * @param PostOutputInterface $output
     * @return void
     */
    public function __construct(PostOutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Build the template view post.
     *
     * @param string $title 
     * @return void
     */
    public function build($post_path, $title)
    {   
        $this->output->build($post_path, $title);
    }

}
