<?phpnamespace App\Services;use App\Models\Currency;use Carbon\Carbon;class CurrencyConversion{    protected static $container;    const DEFAULT_CURRENCY_CODE = 'RUB';    public static function loadContainer() {        if(is_null(self::$container)) {            $currencies = Currency::get();            foreach ($currencies as $currency) {                self::$container[$currency->code] = $currency;            }        }    }    public static function getCurrencies() {        self::loadContainer();        return self::$container;    }    public static function getCurrencyCodeCurrencyFromSession() {        return session('currency',self::DEFAULT_CURRENCY_CODE);    }    public static function getCurrentCurrencyFromSession() {        self::loadContainer();        return self::$container[self::getCurrencyCodeCurrencyFromSession()];    }    public static function convert($sum,$originCurrencyCode = self::DEFAULT_CURRENCY_CODE,$targetCurrencyCode = null) {        self::loadContainer();        $originCurrency = self::$container[$originCurrencyCode];        if($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {            if($originCurrency['rate'] == 0 || $originCurrency['code'] !== self::DEFAULT_CURRENCY_CODE && $originCurrency->updated_at->startOfDay() !== Carbon::now()->startOfDay()) {                CurrencyRates::getRates();                self::loadContainer();                $originCurrency = self::$container[$originCurrencyCode];            }        }        if(is_null($targetCurrencyCode)) {            $targetCurrencyCode = self::getCurrencyCodeCurrencyFromSession();        }        $targetCurrency = self::$container[$targetCurrencyCode];        if($targetCurrency['rate'] == 0 || $targetCurrency['code'] !== self::DEFAULT_CURRENCY_CODE && $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {            CurrencyRates::getRates();            self::loadContainer();            $targetCurrency = self::$container[$targetCurrencyCode];        }        return $sum / $originCurrency['rate'] * $targetCurrency['rate'];    }    //App\Services\CurrencyConversion::getCurrencySymbol()    public static function getCurrencySymbol() {        self::loadContainer();        return self::$container[session('currency',self::DEFAULT_CURRENCY_CODE)]['symbol'];    }    public static function getCurrentCurrency() {        self::loadContainer();        foreach(self::$container as $code => $currency) {            if($currency->isMain()) return $currency;        }    }}