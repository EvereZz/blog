<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ Laravel blog ]]></title>
        <link><![CDATA[ http://127.0.0.1:8000 ]]></link>
        <description><![CDATA[ Your blog provider ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ '/posts/' . $post->slug }}</link>
                <description><![CDATA[{!! $post->excerpt !!}]]></description>
                <category>{{ $post->category->name }}</category>
                <author><![CDATA[{{ $post->author->name  }}]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>