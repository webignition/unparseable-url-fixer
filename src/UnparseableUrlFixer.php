<?php

namespace webignition\UnparseableUrlFixer;

class UnparseableUrlFixer
{
    const LOCATION_HEADER_NAME = 'Location';

    public function fix(string $url)
    {
        $url = $this->fixTripleSlashAfterHttpScheme($url);

        return $url;
    }

    private function fixTripleSlashAfterHttpScheme(string $url): string
    {
        $matches = [];
        $tripleSlashAfterSchemePattern = '#[a-z]+:///#';

        if (preg_match($tripleSlashAfterSchemePattern, $url, $matches)) {
            $invalidScheme = $matches[0];
            $validScheme = substr($invalidScheme, 0, -1);

            $url = (string) preg_replace($tripleSlashAfterSchemePattern, $validScheme, $url);
        }

        return $url;
    }
}
