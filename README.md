# BetterCoinFlip

A simple and interactive coin flipping plugin for PocketMine-MP 5.x servers.

## Description

BetterCoinFlip is a lightweight plugin that adds a fun coin flip command to your PocketMine-MP server. When a player uses the command, they'll see an animated coin flip with sound effects (if supported) and receive the result (Heads or Tails).

## Features

- Interactive coin flip animation
- Sound effects (on supported versions)
- Title and message displays
- Simple permission system
- Works on PocketMine-MP 5.3.0+

## Installation

1. Download the latest release from [GitHub](https://github.com/DaDevGuy/CoinFlip/releases) or Poggit
2. Place the downloaded `.phar` file into your server's `plugins` folder
3. Restart your server or use the `load` command to load the plugin

## Commands

| Command | Description | Permission |
|---------|-------------|------------|
| `/flip` | Flip a coin and get Heads or Tails | `flip.coin` |

## Permissions

| Permission | Description | Default |
|------------|-------------|---------|
| `flip.coin` | Allows the player to use the flip command | `true` |

## Usage

Simply type `/flip` in the chat to flip a coin. You will see an animated sequence and then the final result (Heads or Tails).

## Requirements

- PocketMine-MP API 5.3.0+
- PHP 7.4 or newer

## License

This project is licensed under the [MIT License](LICENSE) - see the LICENSE file for details.

## Credits

- Developed by DaDevGuy
- Coin icon provided by [Flaticon](https://www.flaticon.com/)

## Planned Features

- Economy support for betting on coin flips

## Support

If you encounter any issues or have suggestions, please create an issue on the [GitHub repository](https://github.com/DaDevGuy/CoinFlip/issues).