<?php


namespace App\Supports\Redis;

use Illuminate\Support\Facades\Redis;

/**
 * Class RedisHelper
 * @package App\Supports\Redis
 * @method static int    del(array $keys)
 * @method static string dump($key)
 * @method static int    exists($key)
 * @method static int    expire($key, $seconds)
 * @method static int    expireat($key, $timestamp)
 * @method static array  keys($pattern)
 * @method static int    move($key, $db)
 * @method static mixed  object($subcommand, $key)
 * @method static int    persist($key)
 * @method static int    pexpire($key, $milliseconds)
 * @method static int    pexpireat($key, $timestamp)
 * @method static int    pttl($key)
 * @method static string randomkey()
 * @method static mixed  rename($key, $target)
 * @method static int    renamenx($key, $target)
 * @method static array  scan($cursor, array $options = null)
 * @method static array  sort($key, array $options = null)
 * @method static int    ttl($key)
 * @method static mixed  type($key)
 * @method static int    append($key, $value)
 * @method static int    bitcount($key, $start = null, $end = null)
 * @method static int    bitop($operation, $destkey, $key)
 * @method static array  bitfield($key, $subcommand, ...$subcommandArg)
 * @method static int    decr($key)
 * @method static int    decrby($key, $decrement)
 * @method static string get($key)
 * @method static int    getbit($key, $offset)
 * @method static string getrange($key, $start, $end)
 * @method static string getset($key, $value)
 * @method static int    incr($key)
 * @method static int    incrby($key, $increment)
 * @method static string incrbyfloat($key, $increment)
 * @method static array  mget(array $keys)
 * @method static mixed  mset(array $dictionary)
 * @method static int    msetnx(array $dictionary)
 * @method static mixed  psetex($key, $milliseconds, $value)
 * @method static mixed  set($key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
 * @method static int    setbit($key, $offset, $value)
 * @method static int    setex($key, $seconds, $value)
 * @method static int    setnx($key, $value)
 * @method static int    setrange($key, $offset, $value)
 * @method static int    strlen($key)
 * @method static int    hdel($key, array $fields)
 * @method static int    hexists($key, $field)
 * @method static string hget($key, $field)
 * @method static array  hgetall($key)
 * @method static int    hincrby($key, $field, $increment)
 * @method static string hincrbyfloat($key, $field, $increment)
 * @method static array  hkeys($key)
 * @method static int    hlen($key)
 * @method static array  hmget($key, array $fields)
 * @method static mixed  hmset($key, array $dictionary)
 * @method static array  hscan($key, $cursor, array $options = null)
 * @method static int    hset($key, $field, $value)
 * @method static int    hsetnx($key, $field, $value)
 * @method static array  hvals($key)
 * @method static int    hstrlen($key, $field)
 * @method static array  blpop(array $keys, $timeout)
 * @method static array  brpop(array $keys, $timeout)
 * @method static array  brpoplpush($source, $destination, $timeout)
 * @method static string lindex($key, $index)
 * @method static int    linsert($key, $whence, $pivot, $value)
 * @method static int    llen($key)
 * @method static string lpop($key)
 * @method static int    lpush($key, array $values)
 * @method static int    lpushx($key, $value)
 * @method static array  lrange($key, $start, $stop)
 * @method static int    lrem($key, $count, $value)
 * @method static mixed  lset($key, $index, $value)
 * @method static mixed  ltrim($key, $start, $stop)
 * @method static string rpop($key)
 * @method static string rpoplpush($source, $destination)
 * @method static int    rpush($key, array $values)
 * @method static int    rpushx($key, $value)
 * @method static int    sadd($key, array $members)
 * @method static int    scard($key)
 * @method static array  sdiff(array $keys)
 * @method static int    sdiffstore($destination, array $keys)
 * @method static array  sinter(array $keys)
 * @method static int    sinterstore($destination, array $keys)
 * @method static int    sismember($key, $member)
 * @method static array  smembers($key)
 * @method static int    smove($source, $destination, $member)
 * @method static string spop($key, $count = null)
 * @method static string srandmember($key, $count = null)
 * @method static int    srem($key, $member)
 * @method static array  sscan($key, $cursor, array $options = null)
 * @method static array  sunion(array $keys)
 * @method static int    sunionstore($destination, array $keys)
 * @method static int    zadd($key, array $membersAndScoresDictionary)
 * @method static int    zcard($key)
 * @method static string zcount($key, $min, $max)
 * @method static string zincrby($key, $increment, $member)
 * @method static int    zinterstore($destination, array $keys, array $options = null)
 * @method static array  zrange($key, $start, $stop, array $options = null)
 * @method static array  zrangebyscore($key, $min, $max, array $options = null)
 * @method static int    zrank($key, $member)
 * @method static int    zrem($key, $member)
 * @method static int    zremrangebyrank($key, $start, $stop)
 * @method static int    zremrangebyscore($key, $min, $max)
 * @method static array  zrevrange($key, $start, $stop, array $options = null)
 * @method static array  zrevrangebyscore($key, $max, $min, array $options = null)
 * @method static int    zrevrank($key, $member)
 * @method static int    zunionstore($destination, array $keys, array $options = null)
 * @method static string zscore($key, $member)
 * @method static array  zscan($key, $cursor, array $options = null)
 * @method static array  zrangebylex($key, $start, $stop, array $options = null)
 * @method static array  zrevrangebylex($key, $start, $stop, array $options = null)
 * @method static int    zremrangebylex($key, $min, $max)
 * @method static int    zlexcount($key, $min, $max)
 * @method static int    pfadd($key, array $elements)
 * @method static mixed  pfmerge($destinationKey, array $sourceKeys)
 * @method static int    pfcount(array $keys)
 * @method static mixed  pubsub($subcommand, $argument)
 * @method static int    publish($channel, $message)
 * @method static mixed  discard()
 * @method static array  exec()
 * @method static mixed  multi()
 * @method static mixed  unwatch()
 * @method static mixed  watch($key)
 * @method static mixed  eval($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method static mixed  evalsha($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method static mixed  script($subcommand, $argument = null)
 * @method static mixed  auth($password)
 * @method static string echo ($message)
 * @method static mixed  ping($message = null)
 * @method static mixed  select($database)
 * @method static mixed  bgrewriteaof()
 * @method static mixed  bgsave()
 * @method static mixed  client($subcommand, $argument = null)
 * @method static mixed  config($subcommand, $argument = null)
 * @method static int    dbsize()
 * @method static mixed  flushall()
 * @method static mixed  flushdb()
 * @method static array  info($section = null)
 * @method static int    lastsave()
 * @method static mixed  save()
 * @method static mixed  slaveof($host, $port)
 * @method static mixed  slowlog($subcommand, $argument = null)
 * @method static array  time()
 * @method static array  command()
 * @method static int    geoadd($key, $longitude, $latitude, $member)
 * @method static array  geohash($key, array $members)
 * @method static array  geopos($key, array $members)
 * @method static string geodist($key, $member1, $member2, $unit = null)
 * @method static array  georadius($key, $longitude, $latitude, $radius, $unit, array $options = null)
 * @method static array  georadiusbymember($key, $member, $radius, $unit, array $options = null)
 */
class RedisHelper extends Redis
{
    const TYPE_REDIS = 1;
    const TYPE_MEMORY_OBJECT = 2;
    const TYPE_MEMORY_SERIALIZE = 3;

    // 有效期仅当前会话
    const EXPIRE_SESSION = -100;
    // 随机有效期
    const EXPIRE_RANDOM = -101;
    // 随机
    const EXPIRE_LARGE_RANDOM = -102;

    private static $caches = [];

    /**
     * 快速缓存
     * @param string|array $cacheKey
     * @param int $expire
     * @param callable $dataGetter
     * @param int $cacheType
     * @return mixed|string
     */
    public static function fastCache($cacheKey, int $expire, callable $dataGetter, int $cacheType = self::TYPE_MEMORY_SERIALIZE)
    {
        if (!is_string($cacheKey)) {
            $hash = md5(serialize($cacheKey));
            if (is_array($cacheKey) && count($cacheKey) >= 2) {
                $hash = $cacheKey[1] . $hash;
            }

            $cacheKey = $hash;
        }

        // 内存缓存
        if ($cacheType != self::TYPE_REDIS && isset(self::$caches[$cacheKey])) {
            if ($cacheType == self::TYPE_MEMORY_SERIALIZE) {
                return unserialize(self::$caches[$cacheKey]);
            } elseif ($cacheType == self::TYPE_MEMORY_OBJECT) {
                return self::$caches[$cacheKey];
            }
            return null;
        }

        // 从redis中获取
        $serialized = self::get($cacheKey);
        if (!empty($serialized)) {
            $data = unserialize($serialized);
        } else {
            $data = call_user_func($dataGetter);
            $serialized = serialize($data);
            // 随机有效期
            if ($expire == self::EXPIRE_RANDOM) {
                $expire = rand(30, 120);
            }
            if ($expire == self::EXPIRE_LARGE_RANDOM) {
                $expire = rand(120, 180);
            }
            // 非会话有效期
            if ($expire != self::EXPIRE_SESSION) {
                self::set($cacheKey, $serialized);
                self::expire($cacheKey, $expire);
            }
        }

        // 在内存中建立缓存
        if ($cacheType == self::TYPE_MEMORY_SERIALIZE) {
            self::$caches[$cacheKey] = $serialized;
        } elseif ($cacheType == self::TYPE_MEMORY_OBJECT) {
            self::$caches[$cacheKey] = $data;
        }

        return $data;
    }

    public static function clearMemoryCache()
    {
        self::$caches = [];
    }
}
