<?php
declare(strict_types=1);

namespace App\Infrastructure\Commands;

use App\Domain\DrivenPort\IFetchCatalog;
use App\Domain\DrivenPort\IPlaceOrders;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

final class InteractiveFront extends Command
{
    public function __construct(
        private readonly IFetchCatalog $fetchCatalog,
        private readonly IPlaceOrders $orderPlacer
    ) {
        parent::__construct('front');
    }

    protected function configure(): void
    {
        $this->setDescription('Interactive Front to list products and buy some of them.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Welcome to the SuperMarket CLI');

        $io->section('List of products');

        $catalog = $this->fetchCatalog->fetchCatalog();

        $io->table(
            ['Name', 'Description', 'Price'],
            array_map(
                fn (array $product) => [$product['name'], $product['description'], $product['price']],
                $catalog
            )
        );

        $io->section('Buy products');

        $question = new ChoiceQuestion(
            'Please select the products you want to buy (defaults to 0)',
            array_map(
                fn (array $product) => $product['name'],
                $catalog
            ),
            0
        );

        $selectedProduct = $io->askQuestion($question);

        $quantity = $io->ask(sprintf('You have selected: %s. How many do you want to buy ?', $selectedProduct));

        $this->orderPlacer->placeOrder([
            'productId' => $catalog[array_search($selectedProduct, array_column($catalog, 'name'))]['id'],
            'quantity' => (int) $quantity,
            'unitPrice' => $catalog[array_search($selectedProduct, array_column($catalog, 'name'))]['price']
        ]);

        $io->success(sprintf('You have placed an order to buy %s %s', $quantity, $selectedProduct));

        return Command::SUCCESS;
    }
}
