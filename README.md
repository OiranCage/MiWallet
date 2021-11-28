# PHP

VERSION: 8.0.10

# Init
```php  
use oiran\walletlib\api\WalletLib;
use oiran\walletlib\api\WarningLevel;

WalletLib::init("wallet_data", "/path/to/1/");
WalletLib::init("wallet_data", "/path/to/2/", WarningLevel::NONE);
```

# Store

### add or delete or find  a cache of Wallet with changes
```php  
use oiran\walletlib\api\WalletLib;

WalletLib::store()->add(new Wallet("xuid", "name", 200));
WalletLib::store()->delete("xuid");
WalletLib::store()->findBy("xuid");
```

# Repository

### push array data to all wallet data map
```php  
use oiran\walletlib\api\WalletLib;

WalletLib::repository()->push(new Wallet("xuid", "name", 200));
```

### delete or find Wallet from json data
```php  
use oiran\walletlib\api\WalletLib;

WalletLib::repository()->delete("xuid");
WalletLib::repository()->findBy("xuid");
```

# Wallet

### get player's money amount.
```php  
use oiran\walletlib\api\WalletLib;
use oiran\walletlib\dto\WalletDTO;

// with cache data.
$wallet = WalletLib::store()->findBy("xuid");
$wallet->getMoney();

// with json map.
$wallet = WalletDTO(WalletLib::repository()->findBy("xuid"));
$wallet->getMoney();
```

### earn or spend to player's wallet.
```php  
```
