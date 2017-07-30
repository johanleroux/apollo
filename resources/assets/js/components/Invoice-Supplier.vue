<template>
    <table v-show="supplier" class="table table-condensed pull-right text-right">
        <tr>
            <th v-show="supplier.telephone">Telephone</th>
            <td v-show="supplier.telephone">{{ supplier.telephone }}</td>
        </tr>
        <tr>
            <th v-show="supplier.email">Email</th>
            <td v-show="supplier.email">{{ supplier.email }}</td>
        </tr>
        <tr>
            <th v-show="supplier.address">Address</th>
            <td v-show="supplier.address">{{ supplier.address }}</td>
        </tr>
        <tr>
            <th v-show="supplier.address_2">Secondary Address</th>
            <td v-show="supplier.address_2">{{ supplier.address_2 }}</td>
        </tr>
        <tr>
            <th v-show="supplier.city">City</th>
            <td v-show="supplier.city">{{ supplier.city }}</td>
        </tr>
        <tr>
            <th v-show="supplier.province">Province</th>
            <td v-show="supplier.province">{{ supplier.province }}</td>
        </tr>
        <tr>
            <th v-show="supplier.country">State</th>
            <td v-show="supplier.country">{{ supplier.country }}</td>
        </tr>
    </table>
</template>

<script>
export default {
    props: ['supplier']
}
</script>
