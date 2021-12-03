# Summary
This plugin adds the concept of money to the server.

Wallet data held by the player is stored in `.json` format and written asynchronously.

As for the Option setting, you can change the asynchronous setting to your liking. Basically, there is no need to change the default settings.

# PHP

- use binary version `8.0.10`
- use PocketMine-MP version `API4-beta11+dev2067`

# Wallet 

### get player's Wallet.
```php  
use pocketmine\player\Player;
use oiran\walletlib\api\WalletLib;
use oiran\walletlib\dto\WalletDTO;

/** @var $player Player */
$xuid = $player->getXuid();
$wallet = WalletLib::findWallet($xuid);
```

### check Wallet money amount.
```php  
$wallet->getMoney()->getAmount();
```

### earn or spend Money.
```php  
use oiran\walletlib\model\Money;

$wallet->earn(new Money(200));
$wallet->spend(new Money(100));
```
