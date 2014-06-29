<?php

namespace Celibattante\UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;

class CreateUserCommand extends BaseCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('celibattante:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('genre', InputArgument::REQUIRED, 'The genre'),
                new InputArgument('city', InputArgument::REQUIRED, 'The city'),
                new InputArgument('description', InputArgument::REQUIRED, 'The description')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
            );
    }

    // ...

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('genre')) {
            $genre = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a genre (M, F):',
                function($genre) {
                    if (empty($genre)) {
                        throw new \Exception('Genre can not be empty');
                    } else if ($genre !== "M" && $genre !== "F") {
						throw new \Exception('Genre must be M or F');
                   	}

                    return $genre;
                }
            );
            $input->setArgument('genre', $genre);
        }
        if (!$input->getArgument('city')) {
            $city = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a city:',
                function($city) {
                    if (empty($city)) {
                        throw new \Exception('City can not be empty');
                    }

                    return $city;
                }
            );
            $input->setArgument('city', $city);
        }

        if (!$input->getArgument('description')) {
            $description = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a description:',
                function($description) {
                    if (empty($description)) {
                        throw new \Exception('Description can not be empty');
                    }

                    return $description;
                }
            );
            $input->setArgument('description', $description);
        }
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');

        /** @var \Acme\AcmeUserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($input->getArgument('username'));
        $user->setEmail($input->getArgument('email'));
        $user->setPlainPassword($input->getArgument('password'));
        $user->setEnabled(!$input->getOption('inactive'));
        $user->setSuperAdmin((bool)$input->getOption('super-admin'));
        $user->setGenre($input->getArgument('genre'));
        $user->setCity($input->getArgument('city'));
        $user->setDescription($input->getArgument('description'));
        $user->setBirthdate(new \DateTime());

        $user_manager->updateUser($user);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $input->getArgument('username')));
    }
}