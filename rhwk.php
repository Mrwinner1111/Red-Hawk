<?php
error_reporting(0);
require 'functions.php';
require 'var.php';
echo $cln;
function update()
    {
        echo "\n\e[91m\e[1m[+] RED HAWK UPDATE UTILITY [+]\nUpdate in progress, please wait...\n\n$cln";
        system("git fetch origin && git reset --hard origin/master && git clean -f -d");
        echo $bold . $fgreen . "[i] Job finished successfully! Please Restart RED HAWK \n" . $cln;
        exit;
    }
    
system("clear");
redhawk_banner();
if (extension_loaded('curl') || extension_loaded('dom'))
  {
  }
else
  {
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "\n[!] cURL Module Is Missing! Try 'fix' command OR Install php-curl" . $cln;
      }
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "\n[!] DOM Module Is Missing! Try 'fix' command OR Install php-xml\n" . $cln;
      }
  }
thephuckinstart:
echo "\n";
userinput("Enter The Website You Want To Scan ");
$ip = trim(fgets(STDIN, 1024));
if ($ip == "help")
  {
    echo "\n\n[+] RED HAWK Help Screen [+] \n\n";
    echo $bold . $lblue . "Commands\n";
    echo "========\n";
    echo $fgreen . "[1] help:$cln View The Help Menu\n";
    echo $bold . $fgreen . "[2] fix:$cln Installs All Required Modules (Suggested If You Are Running The Tool For The First Time)\n";
    echo $bold . $fgreen . "[3] URL:$cln Enter The Domain Name Which You Want To Scan (Format:www.sample.com / sample.com)\n";
    echo $bold . $fgreen . "[4] update:$cln Updates The Script To The Newest Version Available.\n";
    goto thephuckinstart;
  }
elseif ($ip == "fix")
  {
    echo "\n\e[91m\e[1m[+] RED HAWK FiX MENU [+]\n\n$cln";
    echo $bold . $blue . "[+] Checking If cURL module is installed ...\n";
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "[!] cURL Module Not Installed ! \n";
        echo $yellow . "[*] Installing cURL. (Operation requires sudo permission so you might be asked for password) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-curl");
        echo $bold . $fgreen . "[i] cURL Installed. \n";
      }
    else
      {
        echo $bold . $fgreen . "[i] cURL is already installed, Skipping To Next \n";
      }
    echo $bold . $blue . "[+] Checking If php-XML module is installed ...\n";
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "[!] php-XML Module Not Installed ! \n";
        echo $yellow . "[*] Installing php-XML. (Operation requires sudo permission so you might be asked for password) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-xml");
        echo $bold . $fgreen . "[i] DOM Installed. \n";
      }     
    else
      {
        echo $bold . $fgreen . "[i] php-XML is already installed, You Are All SET ;) \n";
      }
    echo $bold . $fgreen . "[i] Job finished successfully! Please Restart RED HAWK \n";
    exit;
  }
elseif ($ip == "update")
  {
    update();
  }

elseif (strpos($ip, '://') !== false)
  {
    echo $bold . $red . "\n[!] (HTTP/HTTPS) Detected In Input! Enter URL Without Http/Https\n" . $CURLOPT_RETURNTRANSFER;
    goto thephuckinstart;
  }
elseif (strpos($ip, '.') == false)
  {
    echo $bold . $red . "\n[!] Invalid URL Format! Enter A Valid URL\n" . $cln;
    goto thephuckinstart;
  }
elseif (strpos($ip, ' ') !== false)
  {
    echo $bold . $red . "\n[!] Invalid URL Format! Enter A Valid URL\n" . $cln;
    goto thephuckinstart;
  }
else
  {
    echo "\n";
    userinput("Enter 1 For HTTP OR Enter 2 For HTTPS");
    echo $cln . $bold . $fgreen;
    $ipsl = trim(fgets(STDIN, 1024));
    if ($ipsl == "2")     
          {
        $ipsl = "https://";
      }
    else
      {
        $ipsl = "http://";
      }
scanlist:

    system("clear");
    echo $bold . $blue . "
      +--------------------------------------------------------------+
      +                  List Of Scans Or Actions                    +
      +--------------------------------------------------------------+
            $lblue Scanning Site : " . $fgreen . $ipsl . $ip . $blue . "
      \n\n";
    echo $yellow . " [0]  Basic Recon$white (Site Title, IP Address, CMS, Cloudflare Detection, Robots.txt Scanner)$yellow \n [1]  Whois Lookup \n [2]  Geo-IP Lookup \n [3]  Grab Banners \n [4]  DNS Lookup \n [5]  Subnet Calculator \n [6]  NMAP Port Scan \n [7]  Subdomain Scanner \n [8]  Reverse IP Lookup & CMS Detection \n [9]  SQLi Scanner$white (Finds Links With Parameter And Scans For Error Based SQLi)$yellow \n [10] Bloggers View$white (Information That Bloggers Might Be Interested In)$yellow \n [11] WordPress Scan$white (Only If The Target Site Runs On WP)$yellow \n [12] Crawler \n [13] MX Lookup \n$magenta [A]  Scan For Everything - (The Old Lame Scanner) \n$blue [F]  Fix (Checks For Required Modules and Installs Missing Ones) \n$fgreen [U]  Check For Updates \n$white [B]  Scan Another Website (Back To Site Selection) \n$red [Q]  Quit! \n\n" . $cln;
askscan:
    userinput("Choose Any Scan OR Action From The Above List");
    $scan = trim(fgets(STDIN, 1024));

    if (!in_array($scan, array(
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        'F',
        'f',
        'A',
        'B',
        'U',
        'Q',
        'a',
        'b',
        'q',
        'u'
        
