### [HttpKernel: Table of Contents](https://github.com/AllianceCMS/AllianceCMS/wiki/HttpKernel:-Table-of-Contents)

### Goals

* We need to define Axis Dispatchers, Events and Listeners for each of the seven HttpKernel Events
    * [See the brainstorming session here]()

### Reference

* [HttpKernel Docs](http://symfony.com/doc/current/components/http_kernel/introduction.html)
* [HttpKernel Overview](http://symfony.com/doc/current/components/http_kernel/introduction.html#httpkernel-driven-by-events)
* [HttpKernel::handle() API](http://api.symfony.com/2.4/Symfony/Component/HttpKernel/HttpKernel.html#handle%28%29)
* [HttpKernelInterface::handle() API](http://api.symfony.com/2.4/Symfony/Component/HttpKernel/HttpKernelInterface.html#handle%28%29)
* [HttpKernel - "A Full Working Example"](http://symfony.com/doc/current/components/http_kernel/introduction.html#http-kernel-working-example)
* [Kernel Events Information Table](http://symfony.com/doc/current/components/http_kernel/introduction.html#component-http-kernel-event-table)

### Workflow Stages

The [HttpKernel::handle()](http://symfony.com/doc/current/components/http_kernel/introduction.html#httpkernel-driven-by-events) method works internally by dispatching events.

**Steps taken when [HttpKernel::handle()](http://symfony.com/doc/current/components/http_kernel/introduction.html#httpkernel-driven-by-events) is called:**

* [kernel.request](http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-request-event)
    * [Resolve the Controller](http://symfony.com/doc/current/components/http_kernel/introduction.html#resolve-the-controller)
* [kernel.controller](http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-controller-event)
    * [Getting the Controller Arguments](http://symfony.com/doc/current/components/http_kernel/introduction.html#getting-the-controller-arguments)
    * [Calling the Controller](http://symfony.com/doc/current/components/http_kernel/introduction.html#calling-the-controller)
* [kernel.view](http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-view-event)
* [kernel.response](http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-response-event)
* [kernel.finish_request](http://api.symfony.com/2.4/Symfony/Component/HttpKernel/Event/FinishRequestEvent.html) - Not in the official docs
* [kernel.terminate](http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-terminate-event)
* [kernel.exception](http://symfony.com/doc/current/components/http_kernel/introduction.html#handling-exceptions-the-kernel-exception-event)

### Notes
* If this section becomes too large we will separate it into multiple sub-pages
* This is important information for Module developers as well. Although we can restrict access to Events, 3rd Party Modules will be able to tap into many of these events as well. Keep this in mind while designing this system
