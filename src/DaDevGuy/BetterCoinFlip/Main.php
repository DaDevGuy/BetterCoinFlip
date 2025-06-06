<?php
declare(strict_types=1);

namespace DaDevGuy\BetterCoinFlip;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\ClosureTask;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @param Player $player
     * @param string $result
     */
    private function playCoinFlipAnimation(Player $player, string $result): void {
        $animationFrames = [
            TextFormat::YELLOW . "Flipping coin" . TextFormat::WHITE . ".",
            TextFormat::YELLOW . "Flipping coin" . TextFormat::WHITE . "..",
            TextFormat::YELLOW . "Flipping coin" . TextFormat::WHITE . "...",
            TextFormat::YELLOW . "Flipping coin" . TextFormat::WHITE . "....",
            TextFormat::YELLOW . "The coin is spinning in the air" . TextFormat::WHITE . ".",
            TextFormat::YELLOW . "The coin is spinning in the air" . TextFormat::WHITE . "..",
            TextFormat::YELLOW . "The coin is spinning in the air" . TextFormat::WHITE . "...",
            TextFormat::YELLOW . "The coin is about to land" . TextFormat::WHITE . "..."
        ];

        $frameIndex = 0;
        $scheduler = $this->getScheduler();

        $player->sendTitle(TextFormat::GOLD . "Flipping Coin", TextFormat::YELLOW . "Watch the coin flip!");

        if(method_exists($player, "playSound")) {
            $player->playSound("random.click", 1, 1, true);
        }

        // animate frames
        $taskHandler = $scheduler->scheduleRepeatingTask(new ClosureTask(
            function() use ($player, $animationFrames, &$frameIndex, &$taskHandler, $result, $scheduler): void {
                if($frameIndex < count($animationFrames)) {
                    $player->sendTip($animationFrames[$frameIndex]);
                    $frameIndex++;
                } else {

                    $player->sendTitle(
                        TextFormat::GOLD . $result, 
                        TextFormat::GREEN . "You flipped a coin and got: " . TextFormat::GOLD . $result
                    );

                    // Play final sound
                    if(method_exists($player, "playSound")) {
                        $player->playSound("random.pop", 1, 1, true);
                    }

                    $player->sendMessage(TextFormat::GREEN . "You flipped a coin and got: " . TextFormat::GOLD . $result);

                    $taskHandler->cancel();
                }
            }
        ), 10); // ts to run it every 10 ticks
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if($command->getName() === "flip") {
            if(!$sender->hasPermission("bettercoinflip.cmd.flip")) {
                $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command!");
                return true;
            }

            $result = (mt_rand(0, 1) === 0) ? "Heads" : "Tails";

            if($sender instanceof Player) {
                // Start the coin flip animation
                $this->playCoinFlipAnimation($sender, $result);
            } else {
                $sender->sendMessage(TextFormat::GREEN . "Coin flip result: " . TextFormat::GOLD . $result);
            }

            return true;
        }

        return false;
    }
}