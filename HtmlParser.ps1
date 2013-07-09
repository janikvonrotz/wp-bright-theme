# function
function Replace-LineContent{

    param(
        [string[]]$Content,
        [string]$LineBeginTrim,
        [string]$LineEndTrim,
        [string]$ContentInsertAfterTrim
    )
    
    $RemoveThisLine = $false
    $TempContent = @()

    foreach ($Line in $Content){  
        # found line from
        if($Line.contains($LineBeginTrim) -or $RemoveThisLine){    
            $RemoveThisLine = $true                
            # found end of remove section
            if($Line.contains($LineEndTrim) -and $RemoveThisLine){        
                $RemoveThisLine = $false                    
                # insert tumblr content here
                $TempContent += $ContentInsertAfterTrim         
            }     
        }else{    
            $TempContent += $Line    
        }   
    } 
    return $TempContent
}

# settings

$Url = "http://janikvonrotz.ch"
$DestinationFile = "index.html"

# get html code
$WebClient = New-Object System.Net.WebClient
$WebClient.DownloadFile($Url, $DestinationFile)
$HtmlContent = Get-Content -Path $DestinationFile

# Tumblr settings

$TumblrHeaderTitle = "<title>{Title}</title>"
$TumblrFavicon = '<link rel="shortcut icon" href="{Favicon}">'
$TumblrRSSLink = '<link rel="alternate" type="application/rss+xml" href="{RSS}">'
$TumblrSiteTitle = '<h1 class="site-title">{Title}</h1>'
$TumblrSiteDescription = @'
{block:Description}
    <h1 class="site-description"><small>{Description}</small></h1>
{/block:Description}
'@
$TumblrPostLoop = @'
<div id="content" class="site-content span7 offset1" role="main">

	<div id="posts">
		{block:Posts}
			{block:Text}
				<article class="post text">
					{block:Title}
						<h1><a href="{Permalink}">{Title}</a></h1>
					{/block:Title}

					{Body}
				</article>
			{/block:Text}

			{block:Photo}
				<article class="post photo">
					<img src="{PhotoURL-500}" alt="{PhotoAlt}"/>

					{block:Caption}
						<div class="caption">{Caption}</div>
					{/block:Caption}
				</article>
			{/block:Photo}

			{block:Panorama}
				<article class="post panorama">
					{LinkOpenTag}
						<img src="{PhotoURL-Panorama}" alt="{PhotoAlt}"/>
					{LinkCloseTag}

					{block:Caption}
						<div class="caption">{Caption}</div>
					{/block:Caption}
				</article>
			{/block:Panorama}

			{block:Photoset}
				<article class="post photoset">
					{Photoset-500}

					{block:Caption}
						<div class="caption">{Caption}</div>
					{/block:Caption}
				</article>
			{/block:Photoset}

			{block:Quote}
				<article class="post quote">
					"{Quote}"

					{block:Source}
						<div class="source">{Source}</div>
					{/block:Source}
				</article>
			{/block:Quote}

			{block:Link}
				<article class="post link">
					<a href="{URL}" class="link" {Target}>{Name}</a>

					{block:Description}
						<div class="description">{Description}</div>
					{/block:Description}
				</article>
			{/block:Link}

			{block:Chat}
				<article class="post chat">
					{block:Title}
						<h3><a href="{Permalink}">{Title}</a></h3>
					{/block:Title}

					<ul class="chat">
						{block:Lines}
							<li class="{Alt} user_{UserNumber}">
								{block:Label}
									<span class="label">{Label}</span>
								{/block:Label}

								{Line}
							</li>
						{/block:Lines}
					</ul>
				</article>
			{/block:Chat}

			{block:Video}
				<article class="post video">
					{Video-500}

					{block:Caption}
						<div class="caption">{Caption}</div>
					{/block:Caption}
				</article>
			{/block:Video}

			{block:Audio}
				<article class="post audio">
					{AudioPlayerBlack}

					{block:Caption}
						<div class="caption">{Caption}</div>
					{/block:Caption}
				</article>
			{/block:Audio}
		{/block:Posts}
	</div>
		
	<nav role="navigation" id="nav-below" class="navigation-paging">
		<ul class="pager">
			{block:PreviousPage}
				<li class="nav-next next">
					<a href="{NextPage}">Next <span class="meta-nav"><i class="icon-arrow-right-light"></i></span></a>
				</li>
			{/block:PreviousPage}

			{block:NextPage}
				<li class="nav-previous previous">
					<a href="{PreviousPage}"><span class="meta-nav"><i class="icon-arrow-left-light"></i></span> Previous</a>
				</li>
			{/block:NextPage}
		</ul>					
	</nav>

</div><!-- #content -->
'@

$TumblrFooter = @'
<a href="http://Tumblr.com/" title="A Semantic Personal Publishing Platform" rel="generator">Proudly powered by Tumblr</a>			
<span class="sep"> | </span>			
Theme: <a href="https://github.com/janikvonrotz/WP-Bright-Theme" rel="design">Bright</a> by <a href="http://janikvonrotz.ch" rel="designer">Janik von Rotz</a>.	
</div><!-- .site-info -->
'@



# replace line
$HtmlContent = $HtmlContent -replace '<link rel="shortcut icon".*>', $TumblrFavicon
$HtmlContent = $HtmlContent -replace '<link rel="alternate" type="application/rss.*/feed/" />', $TumblrRSSLink
$HtmlContent = $HtmlContent -replace '<h1 class="site-title">.*</h1>', $TumblrSiteTitle
$HtmlContent = $HtmlContent -replace '<h1 class="site-description"><small>.*</small></h1>', $TumblrSiteDescription
$HtmlContent = $HtmlContent -replace "<title>.*</title>", $TumblrHeaderTitle  

# remove line
$HtmlContent = $HtmlContent -replace '<link rel="alternate" type="application/rss.*comments/feed/" />',''               
$HtmlContent = $HtmlContent -replace '<link rel="profile".*>',''
$HtmlContent = $HtmlContent -replace '<link rel="pingback".*>',''


# multiline replacement

# post loop
$LineBeginTrim = '<div id="content" class="site-content span7 offset1" role="main">'
$LineEndTrim = '</div><!-- #content -->'
$HtmlContent = Replace-LineContent -Content $HtmlContent -LineBeginTrim $LineBeginTrim -LineEndTrim $LineEndTrim -ContentInsertAfterTrim $TumblrPostLoop 

# navigation
$LineBeginTrim = '<nav id="site-navigation" class="navigation-main span12 pagination-centered" role="navigation">'
$LineEndTrim = '</nav><!-- #site-navigation -->'
$HtmlContent = Replace-LineContent -Content $HtmlContent -LineBeginTrim $LineBeginTrim -LineEndTrim $LineEndTrim -ContentInsertAfterTrim "" 

#footer
$LineBeginTrim = '<a href="http://wordpress.org/" title="A Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress</a>'
$LineEndTrim = '</div><!-- .site-info -->'
$HtmlContent = Replace-LineContent -Content $HtmlContent -LineBeginTrim $LineBeginTrim -LineEndTrim $LineEndTrim -ContentInsertAfterTrim $TumblrFooter 

# export
Set-Content -Value $HtmlContent -Path $DestinationFile