<?php include('header.php') ?>
    <nav>
        <form action="." method="get" id="author_selection">
            <section id="dropmenus" class="dropmenus">
                <?php if ($authors) { ?>
                    <label>Authors:</label>
                    <select name="author_id">
                        <option value="">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <?php if ($author['id'] == $authorId) { ?>
                                <option value="<?= $author['id']; ?>" selected>
                            <?php } else { ?>
                                <option value="<?= $author['id']; ?>">
                            <?php } ?>
                            <?= $author['author']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php } ?>

                <?php if ($authors) { ?>
                    <label>Categories:</label>
                    <select name="category_id">
                        <option value="">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category['id'] == $categoryId) { ?>
                                <option value="<?= $category['id']; ?>" selected>
                            <?php } else { ?>
                                <option value="<?= $category['id']; ?>">
                            <?php } ?>
                            <?= $category['category']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php } ?>
                <input type="submit" value="Submit" class="button blue button-slim">
            </section>
        </form>
    </nav>

    <section>
        <?php if($quotes) { ?>
            <div id="table-overflow-customer" class="table-overflow-customer">
                <table>
                    <tbody>
                    <?php foreach ($quotes as $quote) : ?>
                        <tr class="quote-row">
                            <td colspan="2"><?= $quote['quote']; ?></td>
                        </tr>
                        <tr class="quote-details">
                            <td colspan="1" class="quote-author">&dash;<?= $quote['author']; ?></td>
                            <td colspan="1">(<?= $quote['category']; ?>)</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>
                There are no quotes.
            </p>
        <?php } ?>
    </section>
<?php include('footer.php') ?>