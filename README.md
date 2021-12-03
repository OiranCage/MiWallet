# Summary
This plugin adds the concept of money to the server.

Wallet data held by the player is stored in `.json` format and I/O asynchronously.

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

### check Wallet Money amount.
```php  
$moneyAmount = $wallet->getMoney()->getAmount();
```

### earn or spend Money.
```php  
use oiran\walletlib\model\Money;

$wallet->earn(200);
$wallet->spend(100);
```

### pay Money to other Wallet.
```php  
$to = WalletLib::findWallet("to player xuid");
$from = WalletLib::findWallet("from player xuid");

$from->payTo($to, 300);
```