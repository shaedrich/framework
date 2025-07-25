<?php

namespace Illuminate\Support\Facades;

/**
 * @method static \Illuminate\Foundation\Configuration\ApplicationBuilder configure(string|null $basePath = null)
 * @method static string inferBasePath()
 * @method static string version()
 * @method static void bootstrapWith(string[] $bootstrappers)
 * @method static void afterLoadingEnvironment(\Closure $callback)
 * @method static void beforeBootstrapping(string $bootstrapper, \Closure $callback)
 * @method static void afterBootstrapping(string $bootstrapper, \Closure $callback)
 * @method static bool hasBeenBootstrapped()
 * @method static \Illuminate\Foundation\Application setBasePath(string $basePath)
 * @method static string path(string $path = '')
 * @method static \Illuminate\Foundation\Application useAppPath(string $path)
 * @method static string basePath(string $path = '')
 * @method static string bootstrapPath(string $path = '')
 * @method static string getBootstrapProvidersPath()
 * @method static \Illuminate\Foundation\Application useBootstrapPath(string $path)
 * @method static string configPath(string $path = '')
 * @method static \Illuminate\Foundation\Application useConfigPath(string $path)
 * @method static string databasePath(string $path = '')
 * @method static \Illuminate\Foundation\Application useDatabasePath(string $path)
 * @method static string langPath(string $path = '')
 * @method static \Illuminate\Foundation\Application useLangPath(string $path)
 * @method static string publicPath(string $path = '')
 * @method static \Illuminate\Foundation\Application usePublicPath(string $path)
 * @method static string storagePath(string $path = '')
 * @method static \Illuminate\Foundation\Application useStoragePath(string $path)
 * @method static string resourcePath(string $path = '')
 * @method static string viewPath(string $path = '')
 * @method static string joinPaths(string $basePath, string $path = '')
 * @method static string environmentPath()
 * @method static \Illuminate\Foundation\Application useEnvironmentPath(string $path)
 * @method static \Illuminate\Foundation\Application loadEnvironmentFrom(string $file)
 * @method static string environmentFile()
 * @method static string environmentFilePath()
 * @method static string|bool environment(string|array ...$environments)
 * @method static bool isLocal()
 * @method static bool isProduction()
 * @method static string detectEnvironment(\Closure $callback)
 * @method static bool runningInConsole()
 * @method static bool runningConsoleCommand(string|array ...$commands)
 * @method static bool runningUnitTests()
 * @method static bool hasDebugModeEnabled()
 * @method static void registered(callable $callback)
 * @method static void registerConfiguredProviders()
 * @method static \Illuminate\Support\ServiceProvider register(\Illuminate\Support\ServiceProvider|string $provider, bool $force = false)
 * @method static \Illuminate\Support\ServiceProvider|null getProvider(\Illuminate\Support\ServiceProvider|string $provider)
 * @method static array getProviders(\Illuminate\Support\ServiceProvider|string $provider)
 * @method static \Illuminate\Support\ServiceProvider resolveProvider(string $provider)
 * @method static void loadDeferredProviders()
 * @method static void loadDeferredProvider(string $service)
 * @method static void registerDeferredProvider(string $provider, string|null $service = null)
 * @method static object|mixed make(string $abstract, array $parameters = [])
 * @method static bool bound(string $abstract)
 * @method static bool isBooted()
 * @method static void boot()
 * @method static void booting(callable $callback)
 * @method static void booted(callable $callback)
 * @method static \Symfony\Component\HttpFoundation\Response handle(\Symfony\Component\HttpFoundation\Request $request, int $type = 1, bool $catch = true)
 * @method static void handleRequest(\Illuminate\Http\Request $request)
 * @method static int handleCommand(\Symfony\Component\Console\Input\InputInterface $input)
 * @method static bool shouldMergeFrameworkConfiguration()
 * @method static \Illuminate\Foundation\Application dontMergeFrameworkConfiguration()
 * @method static bool shouldSkipMiddleware()
 * @method static string getCachedServicesPath()
 * @method static string getCachedPackagesPath()
 * @method static bool configurationIsCached()
 * @method static string getCachedConfigPath()
 * @method static bool routesAreCached()
 * @method static string getCachedRoutesPath()
 * @method static bool eventsAreCached()
 * @method static string getCachedEventsPath()
 * @method static \Illuminate\Foundation\Application addAbsoluteCachePathPrefix(string $prefix)
 * @method static \Illuminate\Contracts\Foundation\MaintenanceMode maintenanceMode()
 * @method static bool isDownForMaintenance()
 * @method static never abort(int $code, string $message = '', array $headers = [])
 * @method static \Illuminate\Foundation\Application terminating(callable|string $callback)
 * @method static void terminate()
 * @method static array getLoadedProviders()
 * @method static bool providerIsLoaded(string $provider)
 * @method static array getDeferredServices()
 * @method static void setDeferredServices(array $services)
 * @method static bool isDeferredService(string $service)
 * @method static void addDeferredServices(array $services)
 * @method static void removeDeferredServices(array $services)
 * @method static void provideFacades(string $namespace)
 * @method static string getLocale()
 * @method static string currentLocale()
 * @method static string getFallbackLocale()
 * @method static void setLocale(string $locale)
 * @method static void setFallbackLocale(string $fallbackLocale)
 * @method static bool isLocale(string $locale)
 * @method static void registerCoreContainerAliases()
 * @method static void flush()
 * @method static string getNamespace()
 * @method static \Illuminate\Contracts\Container\ContextualBindingBuilder when(array|string $concrete)
 * @method static void whenHasAttribute(string $attribute, \Closure $handler)
 * @method static bool has(string $id)
 * @method static bool isShared(string $abstract)
 * @method static bool isAlias(string $name)
 * @method static void bind(\Closure|string $abstract, \Closure|string|null $concrete = null, bool $shared = false)
 * @method static bool hasMethodBinding(string $method)
 * @method static void bindMethod(array|string $method, \Closure $callback)
 * @method static mixed callMethodBinding(string $method, mixed $instance)
 * @method static void addContextualBinding(string $concrete, \Closure|string $abstract, \Closure|string $implementation)
 * @method static void bindIf(\Closure|string $abstract, \Closure|string|null $concrete = null, bool $shared = false)
 * @method static void singleton(\Closure|string $abstract, \Closure|string|null $concrete = null)
 * @method static void singletonIf(\Closure|string $abstract, \Closure|string|null $concrete = null)
 * @method static void scoped(\Closure|string $abstract, \Closure|string|null $concrete = null)
 * @method static void scopedIf(\Closure|string $abstract, \Closure|string|null $concrete = null)
 * @method static void extend(string $abstract, \Closure $closure)
 * @method static mixed instance(string $abstract, mixed $instance)
 * @method static void tag(array|string $abstracts, array|mixed $tags)
 * @method static iterable tagged(string $tag)
 * @method static void alias(string $abstract, string $alias)
 * @method static mixed rebinding(string $abstract, \Closure $callback)
 * @method static mixed refresh(string $abstract, mixed $target, string $method)
 * @method static \Closure wrap(\Closure $callback, array $parameters = [])
 * @method static mixed call(callable|string $callback, array $parameters = [], string|null $defaultMethod = null)
 * @method static \Closure|\Closure factory(string $abstract)
 * @method static object|mixed makeWith(string|callable $abstract, array $parameters = [])
 * @method static object|mixed get(string $id)
 * @method static object build(\Closure|string $concrete)
 * @method static mixed resolveFromAttribute(\ReflectionAttribute $attribute)
 * @method static void beforeResolving(\Closure|string $abstract, \Closure|null $callback = null)
 * @method static void resolving(\Closure|string $abstract, \Closure|null $callback = null)
 * @method static void afterResolving(\Closure|string $abstract, \Closure|null $callback = null)
 * @method static void afterResolvingAttribute(string $attribute, \Closure $callback)
 * @method static void fireAfterResolvingAttributeCallbacks(\ReflectionAttribute[] $attributes, mixed $object)
 * @method static string|null currentlyResolving()
 * @method static array getBindings()
 * @method static string getAlias(string $abstract)
 * @method static void forgetExtenders(string $abstract)
 * @method static void forgetInstance(string $abstract)
 * @method static void forgetInstances()
 * @method static void forgetScopedInstances()
 * @method static void resolveEnvironmentUsing(callable|string|null $callback)
 * @method static bool currentEnvironmentIs(array|string $environments)
 * @method static \Illuminate\Foundation\Application getInstance()
 * @method static \Illuminate\Contracts\Container\Container|\Illuminate\Foundation\Application setInstance(\Illuminate\Contracts\Container\Container|null $container = null)
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 *
 * @see \Illuminate\Foundation\Application
 */
class App extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'app';
    }
}
