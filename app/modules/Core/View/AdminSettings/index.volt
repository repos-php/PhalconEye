{#
   PhalconEye

   LICENSE

   This source file is subject to the new BSD license that is bundled
   with this package in the file LICENSE.txt.

   If you did not receive a copy of the license and are unable to
   obtain it through the world-wide-web, please send an email
   to phalconeye@gmail.com so we can send you a copy immediately.
#}

{% extends "layouts/admin.volt" %}

{% block title %}{{ "System settings"|trans }}{% endblock %}

{% block content %}
    <div class="span12">
        <div class="row-fluid">
            {{ form.render() }}
        </div>
        <!--/row-->
    </div><!--/span-->
{% endblock %}
