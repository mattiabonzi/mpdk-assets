<!--
    This file is part of Moodle - https://moodle.org/

    Moodle is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Moodle is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
-->
<!--MPDK-HEADER-->
# {{name}} ({{type}} moodle plugin)


{{{banner}}}


{{{badge}}}
<!--/MPDK-HEADER-->

<!--MPDK-SHORT-DESCRIPTION-->
{{description}}
<!--/MPDK-SHORT-DESCRIPTION-->

<!--MPDK-DESCRIPTION-->
TODO: Write a comprehensive description of the plugin
<!--/MPDK-DESCRIPTION-->

<!--MPDK-TOK-->
## Table of Contents
  - [Requirements](#requirements)
  - [Install](#install)
    - [If your site is registered](#if-your-site-is-registered)
    - [Manually](#manually)
    - [Via GIT](#via-git)
  - [Usage](#usage)
  - [Support](#support)
  - [Contribution](#contribution)
  - [License](#license)
<!--/MPDK-TOK-->

<!--MPDK-REQUIREMENTS-->
## Requirements
The mimium required Moodle version for the latest version of this plugin is: {{min_moodle}}

Check out the [version page](https://moodle.org/plugins/{{shortname}}) on the Moodle plugin direcotry for more infomration.

{{{requirements}}}
<!--/MPDK-REQUIREMENTS-->

<!--MPDK-INSTALL-->
## Install

### If your site is registered
1. Login to your Moodle site as an administrator
2. Go to `Site administration` -> `Plugins` -> `Install plugins`
3. Click on the "Install plugin from the Moodle plugin directory" button
4. Search for {{name}} and click the `Install` button for your plugin
5. Follow the on-screen instructions to complete the installation


### Manually
1. Download the lastest version from the [Moodle plugin directory](https://moodle.org/plugins/{{shortname}})
2. Login to your Moodle site as an administrator
3. Go to `Site administration` -> `Plugins` -> `Install plugins`
4. Click on the `Choose a file` button
5. Follow the on-screen instructions to complete the installation

### Via GIT
1. Clone this repo inside your moodle installation
```bash
cd {{{rel_path}}} && git clone {{{github_repo}}}
```
1. Login to your Moodle site as an administrator
2. Go to `Site administration` or `Dashboard`
3. Follow the on-screen instructions to complete the installation
<!--/MPDK-INSTALL-->

## Usage
Check out the [Documentation page](https://docs.moodle.org/en/{shortname}) on Moodle docs.

<!--MPDK-SUPPORT-->
## Support
For more information and documentation check out the [Documentation page](https://docs.moodle.org/en/{shortname})

If you've found a bug or have a feature request, please open a [Github issue]({{{github_repo}}}/issues)

If you need help or have a question, check out the the [discussion]() on the Moodle Forum
<!--/MPDK-SUPPORT-->

<!--MPDK-CONTRIB-->
## Contribution
If you'd like to contribute to the development of this plugin, please fork the repository on Github and submit a pull request.
Remember to read this [guideline](https://github.com/mattiabonzi/mpdk/blob/master/CONTRIBUTE-TO-PLUGIN.md) first
<!--/MPDK-CONTRIB-->

<!--MPDK-LICENSE-->
## License
&copy; {{{copyright}}}, Code for this plugin is licensed under the GPLv3 license.

Check the [LICENSE.md]() file included with the plugin for more information.
<!--/MPDK-LICENSE-->