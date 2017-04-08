<?php 

namespace Katana\Commands\Post;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Helper\QuestionHelper;

class PostCommandHelper 
{	
	/**
     * Validate if already exist post with this title
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param string $post_path
     * @param int $sequence
     * @return string 
     */
    public function validatePostPath(InputInterface $input, OutputInterface $output, $title, $sequence = 1)
    {   
        $filesystem = new Filesystem();
        $post_path  = $this->genPostPath($title, date('Y-m-d'), $sequence);

        if ($filesystem->exists($post_path.'.md') || 
            $filesystem->exists($post_path.'.blade.php'))
            return  $this->validatePostPath($input, $output, $title, $sequence + 1);

        if ($sequence == 1)
            return $post_path;

        $this->duplicateNotification($output);
        
        $question = new ConfirmationQuestion($this->confirmationMessage(), false);
        $helper   = new QuestionHelper($input, $output, $question);

        if (!$helper->ask($input, $output, $question))
            return $post_path;
    }

    /**
     *  Generate a file path
     * 
     * @param string $title
     * @return  string 
     */
    public function genPostPath($title, $date, $sequence)
    {   
        $title = ($sequence > 1)? sprintf('%s part %s', $title, $sequence ): $title;

        return sprintf('%s/_blog/%s-%s', KATANA_CONTENT_DIR, $date, Str::slug($title));
    }

    /**
     * Return confirmation message 
     * 
     * @return string
     */
    public function confirmationMessage()
    {
        return "<fg=white;options=bold>   Create a sequence? ? (yes) </>";
    }

	/**
     * Display a notification
     * 
     * @param OutputInterface $output
     * @return void
     */
    public function duplicateNotification(OutputInterface $output)
    {   
        $output->writeln([
            "<fg=white;bg=red;>",
            "                                              ",
            "   Warning! There is already a post with      ",
            "   this title!                                ",
            "                                              ",
            "</>"]);
    }

    /**
     * Display a Succefully notification
     * 
     * @param OutputInterface $output
     * @return void
     */
    public function successNotification(OutputInterface $output)
    {
        $output->writeln([
            "<fg=green>", 
            "   Post was generated successfully.",
            "</>"]);
    }
}
