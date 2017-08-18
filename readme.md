## laravel-payvision-payment

用於 在 laravel 中使用 payvision 支付功能，目前僅在項目測試階段，如果使用此包造成損失，本人不承擔任何責任。

常規的laravel 包使用過程
在 app.php 的 providers 中添加

```php
	Waterfox\LaravelPayvisionPayment\LaravelPayvisionPaymentServiceProvider::class
```

aliases 中添加
```php
	'Payvision'         => 'Waterfox\Payvision\PayvisionFacade'
```

使用：

&ensp;&ensp;支付：
```php
	try{
		// 提供兩種方式修改參數
	    // 1. 獲取 Payvision 實例后修改參數
		Payvision::getInstace()->amount = 60;
		
		// 2. 獲取 在 payment 方法中傳入數組
		$result = Payvision::payment([
			'cardExpiryYear' => 2020,
			'cardExpiryMonth' => 12
		]);
		
		// 當返回碼為大於0， 表示出現錯誤， 否則表示成功
		if( $result['code'] > 0 ) {
			dd($result['message']);
			return ;
		} else {
			dd($result);
		}
	} catch( \Exception $e ) {、
		// 可能出現的錯誤: 1. 請求 Payvision 接口超時，2. 請求 Payvision 參數不全， 3. 其他錯誤
		dd($e->getMessage());
	}
```
