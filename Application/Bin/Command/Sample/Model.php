<?php
/**
 * Created by PhpStorm.
 * User: Camael24
 * Date: 16/01/14
 * Time: 17:22
 */
namespace Application\Bin\Command\Sample {

    use Hoa\Console\Chrome\Text;
    use Hoa\File\Finder;

    class Model extends \Hoa\Console\Dispatcher\Kit
    {

        /**
         * Options description.
         *
         * @var \Hoa\Core\Bin\Welcome array
         */
        protected $options = array(
            array('help', \Hoa\Console\GetOption::NO_ARGUMENT, 'h'),
            array('help', \Hoa\Console\GetOption::NO_ARGUMENT, '?'),
        );

        /**
         * The entry method.
         *
         * @access  public
         * @return  int
         */
        public function main()
        {

            $command = null;

            while (false !== $c = $this->getOption($v)) {
                switch ($c) {
                    case 'h':
                    case '?':
                        return $this->usage();
                        break;
                }
            }

            if (!file_exists('hoa://Application/Database/base.db')) {
                exit('Create database before');
            }

            \Hoa\Database\Dal::initializeParameters(array(
                    'connection.list.default.dal' => \Hoa\Database\Dal::PDO,
                    'connection.list.default.dsn' => 'sqlite:hoa://Application/Database/base.db',
                    'connection.autoload' => 'default'
            ));

            $f   = new \Hoa\File\Finder();
            $f
                ->in('hoa://Application/Model/Sample')
                ->name('#.php$#');

            foreach ($f as $file) {
                require_once $file->getPathname();
            }

            return;
        }

        /**
         * The command usage.
         *
         * @access  public
         * @return  int
         */
        public function usage()
        {
            echo \Hoa\Console\Chrome\Text::colorize('Usage:', 'fg(yellow)') . "\n";
            echo '   Welcome ' . "\n\n";

            echo $this->stylize('Options:', 'h1'), "\n";
            echo $this->makeUsageOptionsList(array(
                'help' => 'This help.'
            ));

            return;
        }
    }
}

__halt_compiler();
Load Data model
