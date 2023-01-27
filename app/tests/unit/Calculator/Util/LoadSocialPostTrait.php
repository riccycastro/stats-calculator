<?php

namespace Tests\unit\Calculator\Util;

use DateTime;
use SocialPost\Dto\SocialPostTo;
use Statistics\Calculator\AbstractCalculator;

trait LoadSocialPostTrait
{
    private function fillData(AbstractCalculator $abstractCalculator): AbstractCalculator
    {
        foreach ($this->generateSocialTo() as $socialTo) {
            $abstractCalculator->accumulateData($socialTo);
        }

        return $abstractCalculator;
    }

    private function generateSocialTo(): array
    {
        $response = json_decode(file_get_contents('tests/data/social-posts-response.json'), true);
        $posts = $response['data']['posts'];

        $socialPostsTo = [];

        foreach ($posts as $postData) {
            $socialPostsTo[] = (new SocialPostTo())
                ->setId($postData['id'] ?? null)
                ->setAuthorName($postData['from_name'] ?? null)
                ->setAuthorId($postData['from_id'] ?? null)
                ->setText($postData['message'] ?? null)
                ->setType($postData['type'] ?? null)
                ->setDate(DateTime::createFromFormat(
                    DateTime::ATOM,
                    $postData['created_time']
                ));
        }

        return $socialPostsTo;
    }
}
