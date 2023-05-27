<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use PHPUnit\Framework\TestCase;

class YarnBerryTest extends TestCase
{
    public function testPackages(): void
    {
        $yarnLock = [
            '@types/node@npm:^18' => [
                'version' => '18.16.16',
                'resolution' => '@types/node@npm:18.16.16',
                'checksum' => '0efad726dd1e0bef71c392c708fc5d78c5b39c46b0ac5186fee74de4ccb1b2e847b3fa468da67d62812f56569da721b15bf31bdc795e6c69b56c73a45079ed2d',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'typescript@npm:^5' => [
                'version' => '5.0.4',
                'resolution' => 'typescript@npm:5.0.4',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => '82b94da3f4604a8946da585f7d6c3025fff8410779e5bde2855ab130d05e4fd08938b9e593b6ebed165bda6ad9292b230984f10952cf82f0a0ca07bbeaa08172',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
            'typescript@patch:typescript@^5#~builtin<compat/typescript>' => [
                'version' => '5.0.4',
                'resolution' => 'typescript@patch:typescript@npm%3A5.0.4#~builtin<compat/typescript>::version=5.0.4&hash=b5f058',
                'bin' => [
                    'tsc' => 'bin/tsc',
                    'tsserver' => 'bin/tsserver',
                ],
                'checksum' => 'd26b6ba97b6d163c55dbdffd9bbb4c211667ebebc743accfeb2c8c0154aace7afd097b51165a72a5bad2cf65a4612259344ff60f8e642362aa1695c760d303ac',
                'languageName' => 'node',
                'linkType' => 'hard',
            ],
        ];

        $packages = (new YarnBerry())->packages($yarnLock);

        $this->assertCount(3, $packages);

        $this->assertSame('@types/node', $packages[0]->getName());
        $this->assertSame('18.16.16', $packages[0]->version);
        $this->assertSame('@types/node@npm:18.16.16', $packages[0]->resolution);
        $this->assertSame('0efad726dd1e0bef71c392c708fc5d78c5b39c46b0ac5186fee74de4ccb1b2e847b3fa468da67d62812f56569da721b15bf31bdc795e6c69b56c73a45079ed2d', $packages[0]->checksum);
        $this->assertCount(1, $packages[0]->getConstraints()->all());

        $constraint = $packages[0]->getConstraints()->first();
        $this->assertInstanceOf(Constraint::class, $constraint);
        $this->assertSame('^18', $constraint->range);
        $this->assertSame('npm', $constraint->prefix);

        $this->assertSame('typescript', $packages[1]->getName());
        $this->assertSame('5.0.4', $packages[1]->version);
        $this->assertSame('typescript@npm:5.0.4', $packages[1]->resolution);
        $this->assertSame('82b94da3f4604a8946da585f7d6c3025fff8410779e5bde2855ab130d05e4fd08938b9e593b6ebed165bda6ad9292b230984f10952cf82f0a0ca07bbeaa08172', $packages[1]->checksum);
        $this->assertCount(1, $packages[1]->getConstraints()->all());

        $constraint = $packages[1]->getConstraints()->first();
        $this->assertInstanceOf(Constraint::class, $constraint);
        $this->assertSame('^5', $constraint->range);
        $this->assertSame('npm', $constraint->prefix);
    }
}
