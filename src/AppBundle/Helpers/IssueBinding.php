<?php

namespace AppBundle\Helpers;

use AppBundle\Model\Issue;

/**
 * Class helper for GitHub request/response array binding to/from Issue model.
 */
class IssueBinding
{
    /**
     * Array to Issue model or them array.
     *
     * @param array $array
     *
     * @return Issue|Issue[]|array
     */
    public static function arrayToIssue(array $array)
    {
        // Is a list of issues?
        if (isset($array[0])) {
            foreach ($array as $index => $subArray) {
                $array[$index] = self::createNewIssue($subArray);
            }

            return $array;
        } else {
            return self::createNewIssue($array);
        }
    }

    /**
     * Create new Issue from parameters array.
     *
     * @param array $params
     *
     * @return Issue
     */
    private static function createNewIssue(array $params)
    {
        return (new Issue())
            ->setNumber($params['number'])
            ->setTitle($params['title'])
            ->setBody($params['body'])
            ->setState($params['state'])
            ->setCreatedAt(new \DateTime($params['created_at']))
            ->setUpdatedAt(new \DateTime($params['updated_at']))
        ;
    }

    /**
     * Issue model to array.
     *
     * @param Issue $issue
     *
     * @return array
     */
    public static function issueToArray(Issue $issue)
    {
        return [
            'title' => $issue->getTitle(),
            'body'  => $issue->getBody(),
            'state' => $issue->getState(),
        ];
    }
} 
