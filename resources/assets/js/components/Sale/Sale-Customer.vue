<template>
    <table v-show="customer" class="table table-condensed pull-right text-right">
        <tr>
            <th v-show="customer.telephone">Telephone</th>
            <td v-show="customer.telephone">{{ customer.telephone }}</td>
        </tr>
        <tr>
            <th v-show="customer.email">Email</th>
            <td v-show="customer.email">{{ customer.email }}</td>
        </tr>
        <tr>
            <th v-show="customer.address">Address</th>
            <td v-show="customer.address">{{ customer.address }}</td>
        </tr>
        <tr>
            <th v-show="customer.address_2">Secondary Address</th>
            <td v-show="customer.address_2">{{ customer.address_2 }}</td>
        </tr>
        <tr>
            <th v-show="customer.city">City</th>
            <td v-show="customer.city">{{ customer.city }}</td>
        </tr>
        <tr>
            <th v-show="customer.province">Province</th>
            <td v-show="customer.province">{{ customer.province }}</td>
        </tr>
        <tr>
            <th v-show="customer.country">State</th>
            <td v-show="customer.country">{{ customer.country }}</td>
        </tr>
    </table>
</template>

<script>
export default {
    props: ['customer']
}
</script>
