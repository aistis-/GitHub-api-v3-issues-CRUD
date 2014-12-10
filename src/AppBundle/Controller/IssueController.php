<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\IssueType;
use AppBundle\Helpers\IssueBinding;
use Github\Exception\RuntimeException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Issue controller.
 */
class IssueController extends Controller
{
    /**
     * Issues list action.
     *
     * @param string $username
     * @param string $repository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{username}/{repository}/issues", name="issue_list")
     */
    public function listAction($username, $repository)
    {
        $github = $this->get('github');

        try {
            $issues = $github->api('issue')->all($username, $repository);
            $issues = IssueBinding::arrayToIssue($issues);
        } catch (RuntimeException $e) {
            die('Error! And it is not implemented :(');
        }

        return $this->render(
            ':issues:list.html.twig',
            [
                'issues'     => $issues,
                'username'   => $username,
                'repository' => $repository,
            ]
        );
    }

    /**
     * Issue show action.
     *
     * @param string $username
     * @param string $repository
     * @param int $number
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{username}/{repository}/issue/{number}", name="issue_show", requirements={"number": "\d+"})
     */
    public function showAction($username, $repository, $number)
    {
        $github = $this->get('github');

        try {
            $issue = $github->api('issue')->show($username, $repository, $number);
            $issue = IssueBinding::arrayToIssue($issue);
        } catch (RuntimeException $e) {
            die('Error! And it is not implemented :(');
        }

        return $this->render(
            ':issues:show.html.twig',
            [
                'issue'      => $issue,
                'username'   => $username,
                'repository' => $repository,
            ]
        );
    }

    /**
     * Issue create action.
     *
     * @param Request $request
     * @param string $username
     * @param string $repository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{username}/{repository}/issue/create", name="issue_create")
     */
    public function createAction(Request $request, $username, $repository)
    {
        $form = $this->createForm(new IssueType());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $github = $this->get('github');

            // Security over nine thousand.
            $github->authenticate(
                $this->container->getParameter('username'),
                $this->container->getParameter('password')
            );

            try {
                $github->api('issue')->create(
                    $username,
                    $repository,
                    IssueBinding::issueToArray($form->getData())
                );
            } catch (RuntimeException $e) {
                die('Error! And it is not implemented :(');
            }

            return $this->redirect(
                $this->generateUrl('issue_list', ['username' => $username, 'repository' => $repository])
            );
        }

        return $this->render(
            ':issues:form.html.twig',
            [
                'form'       => $form->createView(),
                'username'   => $username,
                'repository' => $repository,
            ]
        );
    }

    /**
     * Issue edit action.
     *
     * @param Request $request
     * @param string $username
     * @param string $repository
     * @param int $number
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{username}/{repository}/issue/{number}/edit", name="issue_edit", requirements={"number": "\d+"})
     */
    public function editAction(Request $request, $username, $repository, $number)
    {
        $github = $this->get('github');

        try {
            $issue = $github->api('issue')->show($username, $repository, $number);
            $issue = IssueBinding::arrayToIssue($issue);
        } catch (RuntimeException $e) {
            die('Error! And it is not implemented :(');
        }

        $form = $this->createForm(new IssueType(), $issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Security over nine thousand.
            $github->authenticate(
                $this->container->getParameter('username'),
                $this->container->getParameter('password')
            );

            try {
                $github->api('issue')->update(
                    $username,
                    $repository,
                    $number,
                    IssueBinding::issueToArray($form->getData())
                );
            } catch (RuntimeException $e) {
                die('Error! And it is not implemented :(');
            }

            return $this->redirect(
                $this->generateUrl('issue_show',
                    ['username' => $username, 'repository' => $repository, 'number' => $number]
                )
            );
        }

        return $this->render(
            ':issues:form.html.twig',
            [
                'form'       => $form->createView(),
                'username'   => $username,
                'repository' => $repository,
            ]
        );
    }
}
