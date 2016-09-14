        <main>
            <h1>Ask anything you want:</h1>
            <form action="<?= URL . $this->getPageLanguage() . '/home/' ?>" method="post">
                <input type="text" name="question" placeholder="Ask your question">
                <input type="submit" value="Send new question">
            </form>
            <ul>
            <?php $question_list = $this->getPageParameters()['question_list']; ?>
            <?php foreach ($question_list as $question): ?>
                <li><?= $question->question_text; ?></li>
            <?php endforeach; ?>
            </ul>
        </main>
