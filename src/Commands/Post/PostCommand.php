<?php

namespace Katana\Commands\Post;

use Illuminate\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Katana\Builders\Post\MarkdownOutput;
use Katana\Builders\Post\PostBuilder;
use Katana\Builders\Post\BladeOutput;


class PostCommand extends Command
{
    /**
     * @var PostCommandHelper
     */
    private $helper;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var Factory
     */
    private $viewFactory;

    /**
     * PostCommand constructor.
     *
     * @param Factory $viewFactory
     * @param Filesystem $filesystem
     */
    public function __construct(Factory $viewFactory, Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->viewFactory = $viewFactory;
        $this->helper = new PostCommandHelper();
        parent::__construct();
    }

    /**     
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('post')
            ->setDescription('Generate a empty post template')
            ->addArgument('title', InputArgument::OPTIONAL, 'The Post Tilte', 'My New Post')
            ->addOption('m', null, InputOption::VALUE_NONE, 'Create a Markdown template file');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $post   = new PostBuilder($input->getOption('m')? 
                    new MarkdownOutput(): new BladeOutput());

        $title  = $input->getArgument('title');
        $path   = $this->helper->validatePostPath($input, $output, $title);
        
        $post->build($path, $title);
        $this->helper->successNotification($output, $path);
    }

}