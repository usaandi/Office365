const ChecksPrivileges = {

    install(Vue, options) {

        Vue.$isAdmin = () => {
            return authUserRole.name === 'Admin';
        }
    }

};

export default ChecksPrivileges