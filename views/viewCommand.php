<?php $this->_t = 'Shopytech - COMMAND'; ?>


<h1>Page des Commandes</h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th>iD</th>
        <th>date</th>
        <th>customer_id</th>
        <th>payment_type</th>
        <th>total</th>
        <th>status</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product):?>
        <tr>
        <td><p>id</p>
        </td>
        <td>
            <p class="fw-normal mb-1"> order->date()?></p>

        </td>
        <td><p>customer_id</p>
        </td>
        <td>payment_type</td>
        </td>
        <td><p>total</p>
        </td>
        <td><p>status</p>
        </td>
        <td>
            <button type="button" class="btn btn-link btn-sm btn-rounded">
            Edit
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>