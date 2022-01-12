<?php declare(strict_types = 1);

namespace Pd\Supervisor\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


final class RenderCommand extends Command
{

	protected static $defaultName = 'supervisor:render';

	private \Supervisor\Configuration\Configuration $configuration;

	private \Indigo\Ini\Renderer $renderer;


	public function __construct(
		\Supervisor\Configuration\Configuration $configuration,
		\Indigo\Ini\Renderer $renderer
	)
	{
		parent::__construct();
		$this->configuration = $configuration;
		$this->renderer = $renderer;
	}


	protected function configure(): void
	{
		parent::configure();
		$this->setDescription('Renders supervisor configuration');
	}


	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$output->write($this->renderer->render($this->configuration->toArray()));

		return 0;
	}

}
