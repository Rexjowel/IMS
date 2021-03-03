import * as actions from '../../action-types'

import Axios from 'axios'

export default{
    [actions.ADD_PRODUCT]({commit},payload){
        Axios.post('/product', payload)
        .then(res=>{

        })

        .catch(err=>{
            
        })
    }
}